<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="mb-1 text-2xl font-semibold text-dark dark:text-white">{{ $title }}</h1>
        <p class="mb-0 text-sm text-bodytext">{{ $description }}</p>
    </div>

    @isset($actionUrl)
        <a href="{{ $actionUrl }}" class="btn bg-primary text-white">{{ $actionLabel }}</a>
    @endisset
</div>
