<div aria-label="Progress" class="mt-6">
    <ol role="list" class="divide-y divide-gray-300 rounded-md border border-gray-300 md:flex md:divide-y-0">
        <li class="relative md:flex md:flex-1">
            <!-- Completed Step -->
            <a href="#" class="group flex w-full items-center">
              <span class="flex items-center px-6 py-4 text-sm font-medium">
                <span
                    class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full @if(session()->has('form_identification')) bg-blue-500 group-hover:bg-blue-700 @endif">
                 @if(session()->has('form_identification'))
                        <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z"
                          clip-rule="evenodd"/>
                  </svg>
                    @else
                        <span
                            class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-blue-600">
                    <span class="text-blue-600">01</span>
                  </span>
                    @endif
                </span>
                <span class="ml-4 text-sm font-medium text-blue-600">Identification</span>
              </span>
            </a>
            <!-- Arrow separator for lg screens and up -->
            <div class="absolute right-0 top-0 hidden h-full w-5 md:block" aria-hidden="true">
                <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                    <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor"
                          stroke-linejoin="round"/>
                </svg>
            </div>
        </li>


        <li class="relative md:flex md:flex-1">
            <!-- Completed Step -->
            <a href="#" class="group flex w-full items-center">

                <span
                    class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-blue-600 @if(session()->has('form_service')) bg-blue-500 group-hover:bg-blue-700 @endif ">
                    @if(session()->has('form_service'))
                        <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z"
                          clip-rule="evenodd"/>
                  </svg>
                    @else
                        <span class="text-blue-600">02</span>
                    @endif
                  </span>

                <span class="ml-4 text-sm font-medium">Produits et services offerts</span>
            </a>
            <!-- Arrow separator for lg screens and up -->
            <div class="absolute right-0 top-0 hidden h-full w-5 md:block" aria-hidden="true">
                <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                    <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor"
                          stroke-linejoin="round"/>
                </svg>
            </div>
        </li>

        <li class="relative md:flex md:flex-1">
            <!-- Current Step -->
            <a href="#" class="flex items-center px-6 py-4 text-sm font-medium" aria-current="step">

              <span
                  class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300 @if(session()->has('form_coordonnee')) bg-blue-500 group-hover:bg-blue-700 @endif ">
                   @if(session()->has('form_coordonnee'))
                      <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z"
                          clip-rule="evenodd"/>
                  </svg>
                  @else
                      <span class="text-gray-500 group-hover:text-gray-900">03</span>
                  @endif
              </span>

                <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">Coordonnées</span>
            </a>
            <!-- Arrow separator for lg screens and up -->
            <div class="absolute right-0 top-0 hidden h-full w-5 md:block" aria-hidden="true">
                <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                    <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor"
                          stroke-linejoin="round"/>
                </svg>
            </div>
        </li>


        <li class="relative md:flex md:flex-1">
            <!-- Upcoming Step -->
            <a href="#" class="group flex items-center">
              <span class="flex items-center px-6 py-4 text-sm font-medium">
                <span
                    class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400">
                  <span class="text-gray-500 group-hover:text-gray-900 ">04</span>
                </span>
                <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">Contact</span>
              </span>
            </a>
        </li>
    </ol>
</div>
