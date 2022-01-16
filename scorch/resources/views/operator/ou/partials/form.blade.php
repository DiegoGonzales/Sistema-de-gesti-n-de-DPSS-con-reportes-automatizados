
                <div class="mb-4">
                    {!! Form::label('name', 'Nombre de OU:' ,['class' => 'py-2 text-xs uppercase font-bold text-gray-500 tracking-wide']) !!}
                    {!! Form::text('name', null, ['autocomplete' => 'off','class' => 'w-full py-1 px-3 
                    placeholder-gray-500 
                    bg-indigo-50 focus:bg-white focus:outline-none
                    border border-transparent rounded focus:border-indigo-500  
                    focus:shadow-md'.($errors->has('name') ? ' border-red-600': '')]) !!}
                    @error('name')
                    <strong class="text-xs text-red-600">{{$message}}</strong>
                    @enderror
                </div>
                <div class="mb-4">
                    {!! Form::label('ruc', 'RUC(opcional):',['class' => 'py-2 text-xs uppercase font-bold text-gray-500 tracking-wide']) !!}
                    {!! Form::text('ruc', null, ['class' => 'w-full py-1 px-3 
                    placeholder-gray-500 
                    bg-indigo-50 focus:bg-white focus:outline-none
                    border border-transparent rounded focus:border-indigo-500  
                    focus:shadow-md']) !!}
                </div>



                <div class="grid grid-cols-3 gap-4">
                    <div>
                        {!! Form::label('level', 'Nivel Jerarquico:',['class' => 'py-2 text-xs uppercase font-bold text-gray-500 tracking-wide']) !!}
                        <br>
                        {!! Form::select('level', [
                        '0' => 'SSEE',
                        '1' => 'Vicepresidencia',
                        '2' => 'Gerencia',
                        '3' => 'Superintendencia'
                        ], null, ['class' => ' placeholder-gray-500 focus:placeholder-white
                        bg-indigo-50 focus:bg-white focus:outline-none
                        border border-transparent rounded focus:border-indigo-500  
                        focus:shadow-md']) !!}
                    </div>

                    <div>
                        {!! Form::label('status', 'Estado:',['class' => 'py-2 text-xs uppercase font-bold text-gray-500 tracking-wide']) !!}
                        <br>
                        {!! Form::select('status', ['0' => 'Sin publicar','1' => 'Activo'], null, ['class' => ' placeholder-gray-500 focus:placeholder-white
                        bg-indigo-50 focus:bg-white focus:outline-none
                        border border-transparent rounded focus:border-indigo-500  
                        focus:shadow-md']) !!}
                    </div>

                    <div>
                        {!! Form::label('master_ou', 'Pertenece a:',['class' => 'py-2 text-xs uppercase font-bold text-gray-500 tracking-wide']) !!}
                        <br>
                        {!! Form::select('master_ou',$allOU, null, ['placeholder' => 'Ninguno' , 
                        'class' => 'w-full placeholder-gray-500 focus:placeholder-white
                        bg-indigo-50 focus:bg-white focus:outline-none
                        border border-transparent rounded focus:border-indigo-500  
                        focus:shadow-md']) !!}
                    </div>
                </div>