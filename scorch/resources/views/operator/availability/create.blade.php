<x-app-layout>
    <style>
  
        .active\:bg-grey-900:active {
            --tw-bg-opacity: 1;
            background-color: rgba(17, 24, 39,var(--tw-bg-opacity));
        }
        .hover\:border-4:hover {
            border-width: 4px;
        }
        .hover\:m-0:hover {
            margin: 0;
        }
        .focus\:border-4:focus {
            border-width: 4px;
        }
        .focus\:m-0:focus {
            margin: 0;
        }
        .active\:border-grey-900:active {
            --tw-bg-opacity: 1;
            border-color: rgba(17, 24, 39,var(--tw-bg-opacity));
        }
        .active\:text-grey-900:active {
            --tw-bg-opacity: 1;
            color: rgba(17, 24, 39,var(--tw-bg-opacity));
        }
        .active\:border-transparent:active {
            border-color: transparent;
        }
    </style>
    <div class="container bg-gray-50 mt-5 py-5 rounded">

        <h1 class="text-3xl font-bold pt-3 pb-7">Registrar Corte de Disponibilidad</h1>

        <form action="{{route('operator.availability.import')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="py-2 px-3 rounded border-t border-r border-l">
                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide">Fecha y Hora</label>
                <br/>
                <input class="h-10 
                placeholder-gray-500 focus:placeholder-white
                bg-indigo-50 focus:bg-white focus:outline-none
                border border-transparent rounded focus:border-indigo-500  
                focus:shadow-md" type="datetime-local" id="date" name="date" value="">
                    @error('date')       
                        <span class="text-xs text-red-500">¡Debes seleccionar una fecha!</span>
                    @enderror
                <br/>
                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide">Autoevaluaciones ejecutadas</label>
                <br/>
                <input class="placeholder-gray-500 focus:placeholder-white
                bg-indigo-50 focus:bg-white focus:outline-none
                border border-transparent rounded focus:border-indigo-500  
                focus:shadow-md" type="text" id="assessments" name="assessments" value="">
                <br/>
    
                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide">Perdida de conexión registradas</label>
                <br/>
                <input class="placeholder-gray-500 focus:placeholder-white
                bg-indigo-50 focus:bg-white focus:outline-none
                border border-transparent rounded focus:border-indigo-500  
                focus:shadow-md" type="text" id="inactives" name="inactives" value="">
                <br/>
            </div>
            <div class="py-2 px-3 rounded border">
                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide">Importe el archivo de AntaSalud</label>
                <br/>
                <input class="text-sm"     type="file" name="import_file">
                <br/>
                <input type="submit" value="Importar y Registrar" class=" mt-4
                bg-indigo-400  hover:bg-indigo-500 
                text-sm  font-medium text-center tracking-wider text-white 
                py-3 px-12 border border-gray-300 hover:border hover:border-indigo-500  rounded 
                transition cursor-pointer"/>
            </div>

            
        </form>
  

    </div>  
</x-app-layout>