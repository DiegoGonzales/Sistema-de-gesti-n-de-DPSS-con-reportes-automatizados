<x-app-layout>

    <div class="container mx-auto bg-gray-50 mt-5 py-5 rounded">
        <h1 class="text-3xl font-bold pt-3 pb-7">Editar de UO</h1>
        {!! Form::model($ou, ['route' => ['operator.ous.update', $ou], 'method' => 'put']) !!}

        @include('operator.ou.partials.form')
        <div class="flex justify-end">
            {!! Form::submit('Actualizar OU', ['class' => '
            bg-indigo-400  hover:bg-indigo-500 
            text-sm  font-medium text-center tracking-wider text-white 
            py-3 px-12 my-2 border border-gray-300 hover:border hover:border-indigo-500  rounded 
            transition float-right cursor-pointer']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</x-app-layout>