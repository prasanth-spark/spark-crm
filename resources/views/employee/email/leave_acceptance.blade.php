<p>Hello</p>

<p>Your team employee {{$user->name}} had apply for leave. 
   so kindly check and permit his/her leave </p>


   @php

   @end   <p>{{$user->name}} have applied as he have {{$reason}}</p>

   <div class="2xl:flex mt-5 mb-3">
        <div class="flex items-center justify-center sm:justify-start">    
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">              
                <a href="http://localhost:8000/employee/leave-accepted/{{$user->id}}/2">Accepted</a>
            </button>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">       
                <a href="http://localhost:8000/employee/leave-accepted/{{$user->id}}/3">Rejected</a>
            </button>
        </div>
    </div>
