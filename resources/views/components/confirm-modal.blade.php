@props(['action', 'title', 'description', 'method' => 'POST', 'confirmText' => 'Confirmar'])

<div x-data="{ open: false, loading: false }" class="inline-block">
    <span @click="open = true" class="cursor-pointer">{{ $trigger }}</span>

    <div x-show="open" style="display: none;" x-transition.opacity.duration.300ms @click.self="open = false"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm p-4">

        <div class="w-full max-w-sm rounded-xl bg-white p-6 shadow-md text-left">
            <h3 class="!font-bold">{{ $title }}</h3>
            <p class="mt-2 text-sm text-gray-500">{{ $description }}</p>

            <div class="mt-6 flex justify-end gap-4 text-sm">
                <button @click="open = false" class="text-gray-500 transition-colors hover:text-black">
                    Cancelar
                </button>

                <form action="{{ $action }}" method="POST" @submit="loading = true" class="m-0">
                    @csrf @method($method)
                    <button type="submit" :disabled="loading"
                        class="rounded-lg bg-red-600 px-4 py-2 text-white transition-colors hover:bg-red-700 disabled:cursor-not-allowed disabled:opacity-50"
                        x-text="loading ? 'Processando...' : '{{ $confirmText }}'">
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
