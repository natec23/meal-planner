@extends('layouts.app')

@section('content')
<div class="container" id="recipie-container">
    @if($recipie)
        <form action="{{ route('recipie.destroy', $recipie) }}" method="post">
            @method('DELETE')
            @csrf
            <input type="submit" value="Delete" class="btn btn-danger" />
        </form>
        <form action="{{ route('recipie.update', $recipie) }}" method="post">
            @method('PUT')
    @else
        <form action="{{ route('recipie.store') }}" method="post">
    @endif
        @csrf
        <div class="row">
            <div class="col-md-9">
                <h2>Recipie</h2>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{old('name', ($recipie ? $recipie->name : ''))}}" class="form-control" />
                    {!! ($errors->first('name') ? '<div class="alert alert-danger" role="alert">'.$errors->first('name').'</div>' : '') !!}
                </div>
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea name="notes" id="notes" class="form-control">{{old('notes', ($recipie ? $recipie->notes : ''))}}</textarea>
                    {!! ($errors->first('notes') ? '<div class="alert alert-danger" role="alert">'.$errors->first('notes').'</div>' : '') !!}
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="prep">Prep Time</label>
                        <div class="input-group">
                            <input type="number" name="prep_time" id="prep" class="form-control" value="{{ old('prep_time', ($recipie ? $recipie->prep_time : '')) }}" />
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">minutes</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cook">Cook Time</label>
                        <div class="input-group">
                            <input type="number" name="cook_time" id="cook" class="form-control" value="{{ old('cook_time', ($recipie ? $recipie->cook_time : '')) }}" />
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">minutes</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="origin">Origin</label>
                    <input type="text" name="origin" id="origin" value="{{ old('origin', ($recipie ? $recipie->origin : '')) }}" class="form-control" />
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="oven">Oven Temperature</label>
                        <div class="input-group">
                            <input type="number" name="oven_temp" id="oven" class="form-control" value="{{ old('oven_temp', ($recipie ? $recipie->oven_temp : '')) }}" />
                            <div class="input-group-prepend">
                                <span class="input-group-text">&#176;F</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="yeild">Yield</label>
                        <div class="input-group">
                            <input type="number" name="yield" id="yield" class="form-control" value="{{ old('yield', ($recipie ? $recipie->yield : '')) }}" />
                            <div class="input-group-prepend">
                                <input type="text" name="yield_unit" class="form-control" value="{{ old('yield_unit', ($recipie ? $recipie->yield_unit : 'Servings')) }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <p><input type="submit" class="btn btn-primary" value="{{ ($recipie ? 'Update' : 'Create') }}" /></p>
            </div>
            <div class="col-md-3">
                <h2>Tags</h2>
            </div>
        </div>
        @if($recipie)
        <div class="row">
            <div class="col-sm-6">
                <h2>Directions</h2>
                <button type="button" v-on:click="addDirection" class="btn"><i class="fas fa-plus"></i></button>
                <ol class="list-group list-group-flush" style="list-style: decimal inside;">
                    <recipie-direction v-for="direction in directions" v-bind:key="direction.id" v-bind:direction="direction" v-bind:edit="true"></recipie-direction>
                </ol>
            </div>
            <div class="col-sm-6">
                <h2>Ingredients</h2>
                <button type="button" v-on:click="addIngredient" class="btn"><i class="fas fa-plus"></i></button>
                <ul class="list-group">
                    <recipie-ingredient v-for="ingredient in ingredients" v-bind:key="ingredient.id" v-bind:ingredient="ingredient" v-bind:edit="true"></recipie-ingredient>
                </ul>
            </div>
        </div>
        @endif
    </form>
    <div v-if="modalDirection">
        <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <span v-if="directionEdit.id">Update</span>
                            <span v-else>Add</span>
                            Direction
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" @click="modalDirection = false">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                           <label for="direction-heading">Heading</label>
                           <input type="text" class="form-control" name="direction-heading" id="direction-heading" v-model="directionEdit.heading" />
                        </div>
                        <div class="form-group">
                           <label for="direction-detail">Details</label>
                           <textarea class="form-control" name="direction-detail" id="direction-detail" v-model="directionEdit.details"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="modalDirection = false">Close</button>
                        <button type="button" class="btn btn-primary"  v-on:click="saveDirection">
                            <span v-if="directionEdit.id">Update</span>
                            <span v-else>Add</span>
                        </button>
                    </div>
                </div>
            </div>

            </div>
        </div>
        </transition>
    </div>

    <div v-if="modalIngredient">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">

                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <span v-if="directionEdit.id">Update</span>
                                <span v-else>Add</span>
                                Ingredient
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" @click="modalIngredient=false">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                            <label for="ingredient-name">Name</label>
                            <input type="text" class="form-control" name="ingredient-name" id="ingredient-name" v-model="ingredientEdit.item.name" required />
                            </div>
                            <div class="form-group">
                            <label for="ingredient-amount">Amount</label>
                            <input type="text" class="form-control" name="ingredient-amount" id="ingredient-amount" v-model="ingredientEdit.amount" required />
                            </div>
                            <div class="form-group">
                            <label for="ingredient-unit">Unit</label>
                            <input type="text" class="form-control" name="ingredient-unit" id="ingredient-unit" v-model="ingredientEdit.unit" />
                            </div>
                            <div class="form-group">
                            <label for="ingredient-notes">Notes</label>
                            <textarea class="form-control" name="ingredient-notes" id="ingredient-notes" v-model="ingredientEdit.notes"></textarea>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="ingredient-optional" id="ingredient-optional" class="form-check-input" v-model="ingredientEdit.optional" />
                                <label class="form-check-label" for="ingredient-optional">Optional</label>
                            </div>
                            <recipie-ingredient v-bind:ingredient="ingredientEdit" v-bind:edit="false"></recipie-ingredient>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="modalIngredient=false">Close</button>
                            <button type="button" class="btn btn-primary"  v-on:click="saveIngredient">
                                <span v-if="ingredientEdit.id">Update</span>
                                <span v-else>Add</span>
                            </button>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </transition>
    </div>
</div>
<script>var recipie_id = {{ ($recipie ? $recipie->id : 'false') }};</script>
@endsection

@section('scripts')
<script src="{{ asset('js/recipies.js') }}" defer></script>
@endsection
