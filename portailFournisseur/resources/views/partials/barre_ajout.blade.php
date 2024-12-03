<div aria-label="Progress" class="mt-6 top-0">
    <ol role="list" class="divide-y divide-gray-300 rounded-md border border-gray-300 md:flex md:divide-y-0 bg-white shadow-lg">
        <li class="relative md:flex md:flex-1">
            <a href="#" class="group flex w-full items-center py-4 hover:bg-gray-50 transition duration-200">
                <span class="flex items-center px-6">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full @if(session()->has('form_identification')) bg-blue-600 text-white @else border-2 border-blue-600 text-blue-600 @endif">
                        @if(session()->has('form_identification'))
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd"/>
                            </svg>
                        @else
                            <span class="text-blue-600">01</span>
                        @endif
                    </span>
                    <span class="ml-4 text-sm font-medium text-blue-600">Identification</span>
                </span>
            </a>
            <div class="absolute right-0 top-0 hidden h-full w-5 md:block" aria-hidden="true">
                <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                    <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round"/>
                </svg>
            </div>
        </li>

        <li class="relative md:flex md:flex-1">
            <a href="#" class="group flex w-full items-center py-4 hover:bg-gray-50 transition duration-200">
                <span class="flex h-10 w-10 items-center justify-center rounded-full @if(session()->has('form_service')) bg-blue-600 text-white @else border-2 border-blue-600 text-blue-600 @endif">
                    @if(session()->has('form_service'))
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd"/>
                        </svg>
                    @else
                        <span class="text-blue-600">02</span>
                    @endif
                </span>
                <span class="ml-4 text-sm font-medium">Produits et services offerts</span>
            </a>
            <div class="absolute right-0 top-0 hidden h-full w-5 md:block" aria-hidden="true">
                <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                    <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round"/>
                </svg>
            </div>
        </li>

        <li class="relative md:flex md:flex-1">
            <a href="#" class="flex items-center px-6 py-4 text-sm font-medium" aria-current="step">
                <span class="flex h-10 w-10 items-center justify-center rounded-full @if(session()->has('form_coordonnee')) bg-blue-600 text-white @else border-2 border-gray-300 text-gray-500 @endif">
                    @if(session()->has('form_coordonnee'))
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd"/>
                        </svg>
                    @else
                        <span class="text-gray-500">03</span>
                    @endif
                </span>
                <span class="ml-4 text-sm font-medium text-gray-500">Coordonnées</span>
            </a>
            <div class="absolute right-0 top-0 hidden h-full w-5 md:block" aria-hidden="true">
                <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                    <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round"/>
                </svg>
            </div>
        </li>

        <li class="relative md:flex md:flex-1">
            <a href="#" class="flex items-center px-6 py-4 text-sm font-medium" aria-current="step">
                <span class="flex h-10 w-10 items-center justify-center rounded-full @if(session()->has('form_contact')) bg-blue-600 text-white @else border-2 border-gray-300 text-gray-500 @endif">
                    @if(session()->has('form_contact'))
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd"/>
                        </svg>
                    @else
                        <span class="text-gray-500">04</span>
                    @endif
                </span>
                <span class="ml-4 text-sm font-medium text-gray-500">Contact</span>
            </a>
            <div class="absolute right-0 top-0 hidden h-full w-5 md:block" aria-hidden="true">
                <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                    <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round"/>
                </svg>
            </div>
        </li>

        <li class="relative md:flex md:flex-1">
            <a href="#" class="group flex items-center">
                <span class="flex items-center px-6 py-4 text-sm font-medium">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400">
                        <span class="text-gray-500">05</span>
                    </span>
                    <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">Brochures</span>
                </span>
            </a>
        </li>
    </ol>
</div>


