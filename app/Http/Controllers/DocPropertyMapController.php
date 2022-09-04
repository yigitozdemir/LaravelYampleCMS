<?php

namespace App\Http\Controllers;

use App\Models\DocPropertyMap;
use App\Models\DocType;
use App\Models\Document;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class DocPropertyMapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Get DocPropertyMap for given DocType id 
     * @param Request $request
     * @param mixed $docTypeId
     * 
     * @return [type]
     */
    public function getDocPropertyMap(Request $request, $docTypeId)
    {
        $docPropertyMaps = DocPropertyMap::where('doc_type_id', '=', $docTypeId);

        return response()->json($docPropertyMaps->get());
    }

    /**
     * Get DocPropertyMap for given DocType id but with property definitions
     * @param Request $request
     * @param mixed $docTypeId
     * 
     * @return [type]
     */
    public function getDocPropertyMapDetails(Request $request, $docTypeId)
    {
        $docPropertyMaps = DocPropertyMap::where('doc_type_id', '=', $docTypeId)->get();
        //fufill the detail
        foreach ($docPropertyMaps as $aMap) {
            $propertyDefinition = PropertyType::find($aMap->property_type_id);
            $aMap['property_definition'] = $propertyDefinition;
        }
        return response()->json($docPropertyMaps);
    }

    /**
     * Add a property to a document
     * @param Request $request
     * @param mixed $prop
     * @param mixed $docTypeId
     * 
     * @return [type]
     */
    public function addPropertyToDoctype(Request $request, $prop, $docTypeId)
    {
        if (!DocType::exists($docTypeId)) {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'DOCTYPE_NOT_FOUND'
                ]
            );
        }

        if (!PropertyType::exists($prop)) {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'PROPERTY_NOT_FOUND'
                ]
            );
        }

        if (DocPropertyMap::where('doc_type_id', '=', $docTypeId)->orWhere('property_type_id', '=', $prop)->count() > 0) {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'ALREADY_EXISTS'
                ]
            );
        } else {
            $newMap = DocPropertyMap::create(
                [
                    'doc_type_id' => $docTypeId,
                    'property_type_id' => $prop,
                ]
            );

            return response()->json(
                [
                    'result' => 'SUCCESS',
                    'reason' => 'ok',
                    'created' => $newMap,
                ]
            );
        }
    }

    /**
     * Remove a property mapping from a Doctype
     * It fails if a document using this type exists
     * @param Request $request
     * @param mixed $prop
     * @param mixed $docTypeId
     * 
     * @return [type]
     */
    public function removePropertyFromDoc(Request $request, $prop, $docTypeId)
    {
        if (Document::usingDocumentType($docTypeId)) {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'DOCTYPE_IN_USE',
                    'explanation' => 'You can not drop a property from a DocType in use',
                ]
            );
        }

        try {
            DocPropertyMap::where('doc_type_id', '=', $docTypeId)->where('property_type_id', '=', $prop)->get()->delete();

            return response()->json(
                [
                    'result' => 'SUCCESS',
                    'reason' => 'ok',
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'result' => 'FAIL',
                    'reason' => 'DATABASE_ERROR',
                ]
            );
        }
    }
}
