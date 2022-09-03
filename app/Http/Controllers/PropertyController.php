<?php

namespace App\Http\Controllers;

use App\Models\DocPropertyMap;
use App\Models\PropertyType;
use Exception;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @param Request $request
     * 
     * @return all property definitions as json
     */
    public function getPropertyDefinitions(Request $request)
    {
        return response()->json(PropertyType::all());
    }

    /**
     * @param Request $request
     * 
     * @return get a property definition given by id
     */
    public function getPropertyDefinition(Request $request, $id)
    {
        return response()->json(PropertyType::find($id));
    }

    /**
     * @param Request $request
     * @param mixed $id
     * 
     * @return delete a property definition given by id
     */
    public function deletePropertyDefinition(Request $request, $id)
    {
        $propertyType = PropertyType::find($id);
        if($propertyType == null) {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'NOT_FOUND',
                    'deleted' => $id
                ]
            );
        }

        $propertyInUse = DocPropertyMap::where('property_type_id', '=', $id);
        if($propertyInUse)
        {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'PROPERTY_IN_USE',
                ]
            );
        }

        $result = $propertyType->delete();
        if($result) {
            return response()->json(
                [
                    'result' => 'SUCCESS',
                    'reason' => 'ok',
                    'deleted' => $id,
                ]
            );
        }

        else
        {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'DB_ERROR',
                    'deleted' => $id
                ]
            );
        }
    }


    /**
     * @param Request $request
     * 
     * @return Create a property type definition
     */
    public function createPropertyDefinition(Request $request) 
    {
        $propertyName = $request->input('name');
        $propertyDescription = $request->input('description');
        $propertyDataType = $request->input('DATA_TYPE');

        // if wrong data type has been sent by user
        if(array_search($propertyDataType, ['INT', 'DATE', 'FLOAT', 'TEXT']) === false)
        {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'WRONG_DATA_TYPE'
                ]
            );
        }

        // if property name has not been sent
        if($propertyName == null || $propertyName == "")
        {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'MISSING_NAME'
                ]
            );
        }
        try
        {
            $propertyType = PropertyType::create([
                'property_name' => $propertyName,
                'property_description' => $propertyDescription,
                'data_type' => $propertyDataType,
            ]);
    
            if($propertyType) {
                return response()->json(
                    [
                        'result' => 'SUCCESS',
                        'reason' => 'ok',
                        'created' => $propertyType,
                    ]
                );
            }
        } 
        catch(\Exception $e)
        {
            if($e->errorInfo[1] == 1062)
            {
                return response()->json(
                    [
                        'result' => 'FAIL',
                        'reason' => 'DUPLICATE_ENTRY'
                    ]
                );
            }
        }
    }


    /**
     * Update a property's name
     * @param Request $request
     * 
     * @return [type]
     */
    public function updatePropertyName(Request $request, $id) 
    {
        //return response()->json(['h' => 'k']);
        $property = PropertyType::find($id);
        if($request->input('name') == null || $request->input('name') == '') 
        {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'MISSING_NAME'
                ]
            );
        }
        $property->property_name = $request->input('name');
        try
        {
            $property->save();
            return response()->json(
                [
                    'result' => 'SUCCESS',
                    'reason' => 'ok',
                    'created' => $property,
                ]
            );
        }
        catch(\Exception $e)
        {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'MISSING_NAME',
                    'detail' => $e
                ]
            );
        }
        
    }

    /**
     * Update a property's description
     * @param Request $request
     * 
     * @return [type]
     */
    public function updatePropertyDescription(Request $request, $id) 
    {
        $property = PropertyType::find($id);
        $property->property_name = $request->input('description');
        try
        {
            $property->save();
            return response()->json(
                [
                    'result' => 'SUCCESS',
                    'reason' => 'ok',
                    'created' => $property,
                ]
            );
        }
        catch(\Exception $e)
        {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'DB_ERROR',
                    'detail' => $e
                ]
            );
        }
    }
}
