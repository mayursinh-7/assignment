<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task Management') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('status'))
                <div class="alert alert-success text-center">
                    {{ session('status') }}
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section class="space-y-6">
                        <header class="flex justify-between items-center">
                            <h2 class="font-semibold text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('My Tasks') }}
                                <span class="font-semibold text-lg font-medium text-gray-600 dark:text-gray-400">({{ count($tasks) }})</span>
                            </h2>
                            <x-secondary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'task-modal')"><i class="fa fa-plus" aria-hidden="true"></i></x-secondary-button>
                        </header>
                        <div class="card-body">
                            <div class="list list-row" id="sortable" data-sortable-id="0" aria-dropeffect="move">
                                @forelse ($tasks as $task)
                                    <div class="task-card dark:bg-gray-900">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    <a href="{{ route('tasks.show', $task->id) }}">#{{ $task->id.' '.$task->title }} <span class="text-sm font-medium text-gray-600 dark:text-gray-400">({{ $task->updated_at->diffForHumans() }})</span></a>
                                                </h3>
                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 m-2">
                                                    {{ $task->description }}
                                                </p>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ route('tasks.show', $task->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="#" x-data="" x-on:click.prevent="$dispatch('open-modal', 'task-modal')" data-id="{{ $task->id }}" class="ml-1 edit-task"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                <form method="post" action="{{ route('tasks.destroy', $task->id) }}" onsubmit="return confirm('Are you sure you want to delete this task?')" class="ml-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 dark:text-red-400 hover:underline"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center">No tasks</p>
                                @endforelse
                            </div>
                        </div>
                    </section>                    
                </div>
            </div>
        </div>
    </div>
    <x-modal name="task-modal" :show="$errors->isNotEmpty()" focusable>
        <form method="post" action="{{ route('tasks.store') }}" class="p-6" id="task-form">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100" id="form-title">Create task</h2>
            @csrf
            <div class="mt-6">
                <x-input-label for="title" value="{{ __('Title') }}" class="sr-only" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" placeholder="{{ __('Title') }}" value="{{ old('title') }}" required autofocus autocomplete="off"/>
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div class="mt-6">
                <x-input-label for="description" value="{{ __('Description') }}" class="sr-only" />
                <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="{{ __('Description') }}" rows="5" required autofocus/>{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close');">{{ __('Cancel') }}</x-secondary-button>
                <x-primary-button class="ms-3">{{ __('Submit') }}</x-primary-button>
            </div>
        </form>
    </x-modal>
@section('scripts')
<script>
$(document).ready(function(){
    Sortable.create(sortable, {
        animation: 100,
        draggable: '.task-card',
        handle: '.task-card',
        sort: true,
        filter: '.sortable-disabled',
        chosenClass: 'active'
    });

    const tasks = {!! $tasks !!}
    const tasksArray = Object.values(tasks);
    $('.edit-task').click(function(){
        let id = $(this).attr('data-id');
        let task = tasksArray.find(task => task.id == id);

        $('#form-title').text('Edit task');
        $('#title').val(task.title);
        $('#description').val(task.description);
        $('#task-form').prepend('<input type="hidden" name="_method" value="PUT">');
        $('#task-form').attr('action', "{{ url('tasks') }}"+"/"+id);
    });
});
</script>
@endsection
</x-app-layout>
