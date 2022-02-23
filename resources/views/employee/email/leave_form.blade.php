<p>Hello {{$user->name}}</p>

<p>You have applied for leave. kindly fill the following using the link</p>


<a href="{{route('leave-request/'.$user->id.)}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">


