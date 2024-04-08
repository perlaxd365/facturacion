@if ($breadcrumb)

    <nav class="mb-4">

        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">

            @foreach ($breadcrumb as $item)
                <li
                    class="text-sm leading-normal text-slate-700 {{ $loop->first ? '' : "pl-2 before:float-left before:pr-2 before:text-gray-600 before:content-['/']" }}">

                    @isset($item['url'])
                        <a class="opacity-50 " href="{{ $item['url'] }}">
                            {{ $item['name'] }}
                        </a>
                    @else
                        {{ $item['name'] }}
                    @endisset

                </li>
            @endforeach
        </ol>

        @if (count($breadcrumb) > 1)
            <h6 class="mb-0 font-bold">
                {{ end($breadcrumb)['name'] }}
            </h6>
        @endif
    </nav>

@endif