<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApartmentFilter extends Model
{
    protected $builder;
    protected $request;

    public function __construct($builder,$request)
    {
       $this->builder = $builder;
       $this->request = $request;
       $this->validation();

    }

    public function apply()
    {
        foreach ($this->filters() as $filter=>$value){
            if(method_exists($this,$filter) and !empty($value)){
                $this->$filter($value);
            }
        }
        return $this->builder;
    }


    public function name($value){
        $this->builder->where('name','like',"%$value%");
    }

    public function bedrooms($value){
        $this->builder->where('bedrooms',$value);
    }

    public function bathrooms($value){
        $this->builder->where('bathrooms',$value);
    }

    public function storeys($value){
        $this->builder->where('storeys',$value);
    }

    public function garages($value){
        $this->builder->where('garages',$value);
    }

    public function max_price($value){
        $this->builder->where('price','<',$value);
    }

    public function min_price($value){
        $this->builder->where('price','>',$value);
    }

    public function filters()
    {
        return $this->request->all();
    }
    public function validation(){
        $v=validator()->make($this->request->all(),[
            'name'=>'string|nullable',
            'max_price'=>'numeric|nullable',
            'min_price'=>'numeric|nullable',
            'bedrooms'=>'integer|nullable',
            'bathrooms'=>'integer|nullable',
            'storeys'=>'integer|nullable',
            'garages'=>'integer|nullable',
        ]);
        if($v->fails()){
            return [];
        }
    }
}
