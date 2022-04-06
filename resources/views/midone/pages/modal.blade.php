@extends('midone/layout/' . $layout)

@section('subhead')
    <title>Modal - Rubick - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="flex items-center mt-8 intro-y">
        <h2 class="mr-auto text-lg font-medium">Modal</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 intro-y lg:col-span-6">
            <!-- BEGIN: Blank Modal -->
            <div class="intro-y box">
                <div class="flex flex-col items-center p-5 border-b border-gray-200 sm:flex-row dark:border-dark-5">
                    <h2 class="mr-auto text-base font-medium">Blank Modal</h2>
                    <div class="flex items-center w-full mt-3 sm:w-auto sm:ml-auto sm:mt-0">
                        <label class="ml-0 form-check-label sm:ml-2" for="show-example-1">Show example code</label>
                        <input id="show-example-1" data-target="#blank-modal" class="ml-3 mr-0 show-code form-check-switch" type="checkbox">
                    </div>
                </div>
                <div id="blank-modal" class="p-5">
                    <div class="preview">
                        <!-- BEGIN: Modal Toggle -->
                        <div class="text-center">
                            <a href="javascript:;" data-toggle="modal" data-target="#basic-modal-preview" class="btn btn-primary">Show Modal</a>
                        </div>
                        <!-- END: Modal Toggle -->
                        <!-- BEGIN: Modal Content -->
                        <div id="basic-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="p-10 text-center modal-body">
                                        This is totally awesome blank modal!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Modal Content -->
                    </div>
                    <div class="hidden source-code">
                        <button data-target="#copy-blank-modal" class="px-2 py-1 copy-code btn btn-outline-secondary">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="mt-3 overflow-y-auto rounded-md">
                            <pre id="copy-blank-modal" class="source-preview">
                                <code class="p-0 pt-8 pb-4 pl-5 -mt-10 -mb-10 text-xs rounded-md html">
                                    {{-- {{ \Hp::formatCode('
                                        <!-- BEGIN: Modal Toggle -->
                                        <div class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#basic-modal-preview" class="btn btn-primary">Show Modal</a>
                                        </div>
                                        <!-- END: Modal Toggle -->
                                        <!-- BEGIN: Modal Content -->
                                        <div id="basic-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="p-10 text-center modal-body">
                                                        This is totally awesome blank modal!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Modal Content -->
                                    ') }} --}}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Blank Modal -->
            <!-- BEGIN: Modal Size -->
            <div class="mt-5 intro-y box">
                <div class="flex flex-col items-center p-5 border-b border-gray-200 sm:flex-row dark:border-dark-5">
                    <h2 class="mr-auto text-base font-medium">Modal Size</h2>
                    <div class="flex items-center w-full mt-3 sm:w-auto sm:ml-auto sm:mt-0">
                        <label class="ml-0 form-check-label sm:ml-2" for="show-example-2">Show example code</label>
                        <input data-target="#modal-size" class="ml-3 mr-0 show-code form-check-switch" type="checkbox" id="show-example-2">
                    </div>
                </div>
                <div id="modal-size" class="p-5">
                    <div class="preview">
                        <div class="text-center">
                            <!-- BEGIN: Small Modal Toggle -->
                            <a href="javascript:;" data-toggle="modal" data-target="#small-modal-size-preview" class="mb-2 mr-1 btn btn-primary">Show Small Modal</a>
                            <!-- END: Small Modal Toggle -->
                            <!-- BEGIN: Medium Modal Toggle -->
                            <a href="javascript:;" data-toggle="modal" data-target="#medium-modal-size-preview" class="mb-2 mr-1 btn btn-primary">Show Medium Modal</a>
                            <!-- END: Medium Modal Toggle -->
                            <!-- BEGIN: Large Modal Toggle -->
                            <a href="javascript:;" data-toggle="modal" data-target="#large-modal-size-preview" class="mb-2 mr-1 btn btn-primary">Show Large Modal</a>
                            <!-- END: Large Modal Toggle -->
                            <!-- BEGIN: Super Large Modal Toggle -->
                            <a href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview" class="mb-2 mr-1 btn btn-primary">Show Superlarge Modal</a>
                            <!-- END: Super Large Modal Toggle -->
                        </div>
                        <!-- BEGIN: Small Modal Content -->
                        <div id="small-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="p-10 text-center modal-body">
                                        This is totally awesome small modal!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Small Modal Content -->
                        <!-- BEGIN: Medium Modal Content -->
                        <div id="medium-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="p-10 text-center modal-body">
                                        This is totally awesome medium modal!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Medium Modal Content -->
                        <!-- BEGIN: Large Modal Content -->
                        <div id="large-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="p-10 text-center modal-body">
                                        This is totally awesome large modal!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Large Modal Content -->
                        <!-- BEGIN: Super Large Modal Content -->
                        <div id="superlarge-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="p-10 text-center modal-body">
                                        This is totally awesome superlarge modal!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Super Large Modal Content -->
                    </div>
                    <div class="hidden source-code">
                        <button data-target="#copy-modal-size" class="px-2 py-1 copy-code btn btn-outline-secondary">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="mt-3 overflow-y-auto rounded-md">
                            <pre id="copy-modal-size" class="source-preview">
                                <code class="p-0 pt-8 pb-4 pl-5 -mt-10 -mb-10 text-xs rounded-md html">
                                    {{-- {{ \Hp::formatCode('
                                        <div class="text-center">
                                            <!-- BEGIN: Small Modal Toggle -->
                                            <a href="javascript:;" data-toggle="modal" data-target="#small-modal-size-preview" class="mb-2 mr-1 btn btn-primary">Show Small Modal</a>
                                            <!-- END: Small Modal Toggle -->
                                            <!-- BEGIN: Medium Modal Toggle -->
                                            <a href="javascript:;" data-toggle="modal" data-target="#medium-modal-size-preview" class="mb-2 mr-1 btn btn-primary">Show Medium Modal</a>
                                            <!-- END: Medium Modal Toggle -->
                                            <!-- BEGIN: Large Modal Toggle -->
                                            <a href="javascript:;" data-toggle="modal" data-target="#large-modal-size-preview" class="mb-2 mr-1 btn btn-primary">Show Large Modal</a>
                                            <!-- END: Large Modal Toggle -->
                                            <!-- BEGIN: Super Large Modal Toggle -->
                                            <a href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview" class="mb-2 mr-1 btn btn-primary">Show Superlarge Modal</a>
                                            <!-- END: Super Large Modal Toggle -->
                                        </div>
                                        <!-- BEGIN: Small Modal Content -->
                                        <div id="small-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="p-10 text-center modal-body">
                                                        This is totally awesome small modal!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Small Modal Content -->
                                        <!-- BEGIN: Medium Modal Content -->
                                        <div id="medium-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="p-10 text-center modal-body">
                                                        This is totally awesome medium modal!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Medium Modal Content -->
                                        <!-- BEGIN: Large Modal Content -->
                                        <div id="large-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="p-10 text-center modal-body">
                                                        This is totally awesome large modal!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Large Modal Content -->
                                        <!-- BEGIN: Super Large Modal Content -->
                                        <div id="superlarge-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="p-10 text-center modal-body">
                                                        This is totally awesome superlarge modal!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Super Large Modal Content -->
                                    ') }} --}}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Modal Size -->
            <!-- BEGIN: Programmatically Show/Hide Modal -->
            <div class="mt-5 intro-y box">
                <div class="flex flex-col items-center p-5 border-b border-gray-200 sm:flex-row dark:border-dark-5">
                    <h2 class="mr-auto text-base font-medium">Programmatically Show/Hide Modal</h2>
                    <div class="flex items-center w-full mt-3 sm:w-auto sm:ml-auto sm:mt-0">
                        <label class="ml-0 form-check-label sm:ml-2" for="show-example-3">Show example code</label>
                        <input id="show-example-3" data-target="#programmatically-show-hide-modal" class="ml-3 mr-0 show-code form-check-switch" type="checkbox">
                    </div>
                </div>
                <div id="programmatically-show-hide-modal" class="p-5">
                    <div class="preview">
                        <!-- BEGIN: Show Modal Toggle -->
                        <div class="text-center">
                            <a id="programmatically-show-modal" href="javascript:;" class="mb-2 mr-1 btn btn-primary">Show Modal</a>
                        </div>
                        <!-- END: Show Modal Toggle -->
                        <!-- BEGIN: Modal Content -->
                        <div id="programmatically-modal" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="p-10 text-center modal-body">
                                        <!-- BEGIN: Hide Modal Toggle -->
                                        <a id="programmatically-hide-modal" href="javascript:;" class="mr-1 btn btn-primary">Hide Modal</a>
                                        <!-- END: Hide Modal Toggle -->
                                        <!-- BEGIN: Toggle Modal Toggle -->
                                        <a id="programmatically-toggle-modal" href="javascript:;" class="mr-1 btn btn-primary">Toggle Modal</a>
                                        <!-- END: Toggle Modal Toggle -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Modal Content -->
                    </div>
                    <div class="hidden source-code">
                        <button data-target="#copy-programmatically-show-hide-modal-js" class="px-2 py-1 copy-code btn btn-outline-secondary">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="mt-3 overflow-y-auto rounded-md">
                            <pre id="copy-programmatically-show-hide-modal-js" class="source-preview">
                                <code class="p-0 pt-8 pb-4 pl-5 -mt-10 -mb-10 text-xs rounded-md html">
                                    {{-- {{ \Hp::formatCode('
                                        <!-- BEGIN: Show Modal Toggle -->
                                        <div class="text-center">
                                            <a id="programmatically-show-modal" href="javascript:;" class="mb-2 mr-1 btn btn-primary">Show Modal</a>
                                        </div>
                                        <!-- END: Show Modal Toggle -->
                                        <!-- BEGIN: Modal Content -->
                                        <div id="programmatically-modal" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="p-10 text-center modal-body">
                                                        <!-- BEGIN: Hide Modal Toggle -->
                                                        <a id="programmatically-hide-modal" href="javascript:;" class="mr-1 btn btn-primary">Hide Modal</a>
                                                        <!-- END: Hide Modal Toggle -->
                                                        <!-- BEGIN: Toggle Modal Toggle -->
                                                        <a id="programmatically-toggle-modal" href="javascript:;" class="mr-1 btn btn-primary">Toggle Modal</a>
                                                        <!-- END: Toggle Modal Toggle -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Modal Content -->
                                    ') }} --}}
                                </code>
                            </pre>
                        </div>
                        <button data-target="#copy-programmatically-show-hide-modal-html" class="px-2 py-1 mt-5 copy-code btn btn-outline-secondary">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="mt-3 overflow-y-auto rounded-md">
                            <pre id="copy-programmatically-show-hide-modal-html" class="source-preview">
                                <code class="p-0 pt-8 pb-4 pl-5 -mt-10 -mb-10 text-xs rounded-md javascript html">
                                    {{-- {{ \Hp::formatCode('
                                        // Show modal
                                        cash(\'#programmatically-show-modal\').on(\'click\', function() {
                                            cash(\'#programmatically-modal\').modal(\'show\')
                                        })

                                        // Hide modal
                                        cash(\'#programmatically-hide-modal\').on(\'click\', function() {
                                            cash(\'#programmatically-modal\').modal(\'hide\')
                                        })

                                        // Toggle modal
                                        cash(\'#programmatically-toggle-modal\').on(\'click\', function() {
                                            cash(\'#programmatically-modal\').modal(\'toggle\')
                                        })
                                    ') }} --}}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Programmatically Show/Hide Modal -->
            <!-- BEGIN: Warning Modal -->
            <div class="mt-5 intro-y box">
                <div class="flex flex-col items-center p-5 border-b border-gray-200 sm:flex-row dark:border-dark-5">
                    <h2 class="mr-auto text-base font-medium">Warning Modal</h2>
                    <div class="flex items-center w-full mt-3 sm:w-auto sm:ml-auto sm:mt-0">
                        <label class="ml-0 form-check-label sm:ml-2" for="show-example-4">Show example code</label>
                        <input id="show-example-4" data-target="#warning-modal" class="ml-3 mr-0 show-code form-check-switch" type="checkbox">
                    </div>
                </div>
                <div id="warning-modal" class="p-5">
                    <div class="preview">
                        <!-- BEGIN: Modal Toggle -->
                        <div class="text-center">
                            <a href="javascript:;" data-toggle="modal" data-target="#warning-modal-preview" class="btn btn-primary">Show Modal</a>
                        </div>
                        <!-- END: Modal Toggle -->
                        <!-- BEGIN: Modal Content -->
                        <div id="warning-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="p-0 modal-body">
                                        <div class="p-5 text-center">
                                            <i data-feather="x-circle" class="w-16 h-16 mx-auto mt-3 text-theme-12"></i>
                                            <div class="mt-5 text-3xl">Oops...</div>
                                            <div class="mt-2 text-gray-600">Something went wrong!</div>
                                        </div>
                                        <div class="px-5 pb-8 text-center">
                                            <button type="button" data-dismiss="modal" class="w-24 btn btn-primary">Ok</button>
                                        </div>
                                        <div class="p-5 text-center border-t border-gray-200 dark:border-dark-5">
                                            <a href="" class="text-theme-1 dark:text-theme-10">Why do I have this issue?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Modal Content -->
                    </div>
                    <div class="hidden source-code">
                        <button data-target="#copy-warning-modal" class="px-2 py-1 copy-code btn btn-outline-secondary">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="mt-3 overflow-y-auto rounded-md">
                            <pre id="copy-warning-modal" class="source-preview">
                                <code class="p-0 pt-8 pb-4 pl-5 -mt-10 -mb-10 text-xs rounded-md html">
                                    {{-- {{ \Hp::formatCode('
                                        <!-- BEGIN: Modal Toggle -->
                                        <div class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#warning-modal-preview" class="btn btn-primary">Show Modal</a>
                                        </div>
                                        <!-- END: Modal Toggle -->
                                        <!-- BEGIN: Modal Content -->
                                        <div id="warning-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="p-0 modal-body">
                                                        <div class="p-5 text-center">
                                                            <i data-feather="x-circle" class="w-16 h-16 mx-auto mt-3 text-theme-12"></i>
                                                            <div class="mt-5 text-3xl">Oops...</div>
                                                            <div class="mt-2 text-gray-600">Something went wrong!</div>
                                                        </div>
                                                        <div class="px-5 pb-8 text-center">
                                                            <button type="button" data-dismiss="modal" class="w-24 btn btn-primary">Ok</button>
                                                        </div>
                                                        <div class="p-5 text-center border-t border-gray-200 dark:border-dark-5">
                                                            <a href="" class="text-theme-1 dark:text-theme-10">Why do I have this issue?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Modal Content -->
                                    ') }} --}}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Warning Modal -->
            <!-- BEGIN: Modal With Close Button -->
            <div class="mt-5 intro-y box">
                <div class="flex flex-col items-center p-5 border-b border-gray-200 sm:flex-row dark:border-dark-5">
                    <h2 class="mr-auto text-base font-medium">Modal With Close Button</h2>
                    <div class="flex items-center w-full mt-3 sm:w-auto sm:ml-auto sm:mt-0">
                        <label class="ml-0 form-check-label sm:ml-2" for="show-example-5">Show example code</label>
                        <input id="show-example-5" data-target="#button-modal" class="ml-3 mr-0 show-code form-check-switch" type="checkbox">
                    </div>
                </div>
                <div id="button-modal" class="p-5">
                    <div class="preview">
                        <!-- BEGIN: Modal Toggle -->
                        <div class="text-center">
                            <a href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="btn btn-primary">Show Modal</a>
                        </div>
                        <!-- END: Modal Toggle -->
                        <!-- BEGIN: Modal Content -->
                        <div id="button-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <a data-dismiss="modal" href="javascript:;">
                                        <i data-feather="x" class="w-8 h-8 text-gray-500"></i>
                                    </a>
                                    <div class="p-0 modal-body">
                                        <div class="p-5 text-center">
                                            <i data-feather="check-circle" class="w-16 h-16 mx-auto mt-3 text-theme-9"></i>
                                            <div class="mt-5 text-3xl">Modal Example</div>
                                            <div class="mt-2 text-gray-600">Modal with close button</div>
                                        </div>
                                        <div class="px-5 pb-8 text-center">
                                            <button type="button" data-dismiss="modal" class="w-24 btn btn-primary">Ok</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Modal Content -->
                    </div>
                    <div class="hidden source-code">
                        <button data-target="#copy-button-modal" class="px-2 py-1 copy-code btn btn-outline-secondary">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="mt-3 overflow-y-auto rounded-md">
                            <pre id="copy-button-modal" class="source-preview">
                                <code class="p-0 pt-8 pb-4 pl-5 -mt-10 -mb-10 text-xs rounded-md html">
                                    {{-- {{ \Hp::formatCode('
                                        <!-- BEGIN: Modal Toggle -->
                                        <div class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="btn btn-primary">Show Modal</a>
                                        </div>
                                        <!-- END: Modal Toggle -->
                                        <!-- BEGIN: Modal Content -->
                                        <div id="button-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <a data-dismiss="modal" href="javascript:;">
                                                        <i data-feather="x" class="w-8 h-8 text-gray-500"></i>
                                                    </a>
                                                    <div class="p-0 modal-body">
                                                        <div class="p-5 text-center">
                                                            <i data-feather="check-circle" class="w-16 h-16 mx-auto mt-3 text-theme-9"></i>
                                                            <div class="mt-5 text-3xl">Modal Example</div>
                                                            <div class="mt-2 text-gray-600">Modal with close button</div>
                                                        </div>
                                                        <div class="px-5 pb-8 text-center">
                                                            <button type="button" data-dismiss="modal" class="w-24 btn btn-primary">Ok</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Modal Content -->
                                    ') }} --}}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Modal With Close Button -->
            <!-- BEGIN: Static Backdrop Modal -->
            <div class="mt-5 intro-y box">
                <div class="flex flex-col items-center p-5 border-b border-gray-200 sm:flex-row dark:border-dark-5">
                    <h2 class="mr-auto text-base font-medium">Static Backdrop Modal</h2>
                    <div class="flex items-center w-full mt-3 sm:w-auto sm:ml-auto sm:mt-0">
                        <label class="ml-0 form-check-label sm:ml-2" for="show-example-11">Show example code</label>
                        <input id="show-example-11" data-target="#static-backdrop-modal" class="ml-3 mr-0 show-code form-check-switch" type="checkbox">
                    </div>
                </div>
                <div id="static-backdrop-modal" class="p-5">
                    <div class="preview">
                        <!-- BEGIN: Modal Toggle -->
                        <div class="text-center">
                            <a href="javascript:;" data-toggle="modal" data-target="#static-backdrop-modal-preview" class="btn btn-primary">Show Modal</a>
                        </div>
                        <!-- END: Modal Toggle -->
                        <!-- BEGIN: Modal Content -->
                        <div id="static-backdrop-modal-preview" class="modal" data-backdrop="static" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="px-5 py-10 modal-body">
                                        <div class="text-center">
                                            <div class="mb-5">I will not close if you click outside me. Don't even try to press escape key.</div>
                                            <button type="button" data-dismiss="modal" class="w-24 btn btn-primary">Ok</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Modal Content -->
                    </div>
                    <div class="hidden source-code">
                        <button data-target="#copy-button-modal" class="px-2 py-1 copy-code btn btn-outline-secondary">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="mt-3 overflow-y-auto rounded-md">
                            <pre id="copy-button-modal" class="source-preview">
                                <code class="p-0 pt-8 pb-4 pl-5 -mt-10 -mb-10 text-xs rounded-md html">
                                    {{-- {{ \Hp::formatCode('
                                        <!-- BEGIN: Modal Toggle -->
                                        <div class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#static-backdrop-modal-preview" class="btn btn-primary">Show Modal</a>
                                        </div>
                                        <!-- END: Modal Toggle -->
                                        <!-- BEGIN: Modal Content -->
                                        <div id="static-backdrop-modal-preview" class="modal" data-backdrop="static" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="px-5 py-10 modal-body">
                                                        <div class="text-center">
                                                            <div class="mb-5">I will not close if you click outside me. Don\'t even try to press escape key.</div>
                                                            <button type="button" data-dismiss="modal" class="w-24 btn btn-primary">Ok</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Modal Content -->
                                    ') }} --}}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Static Backdrop Modal -->
        </div>
        <div class="col-span-12 intro-y lg:col-span-6">
            <!-- BEGIN: Overlapping Modal -->
            <div class="intro-y box">
                <div class="flex flex-col items-center p-5 border-b border-gray-200 sm:flex-row dark:border-dark-5">
                    <h2 class="mr-auto text-base font-medium">Overlapping Modal</h2>
                    <div class="flex items-center w-full mt-3 sm:w-auto sm:ml-auto sm:mt-0">
                        <label class="ml-0 form-check-label sm:ml-2" for="show-example-6">Show example code</label>
                        <input id="show-example-6" data-target="#overlapping-modal" class="ml-3 mr-0 show-code form-check-switch" type="checkbox">
                    </div>
                </div>
                <div id="overlapping-modal" class="p-5">
                    <div class="preview">
                        <!-- BEGIN: Modal Toggle -->
                        <div class="text-center">
                            <a href="javascript:;" data-toggle="modal" data-target="#overlapping-modal-preview" class="btn btn-primary">Show Modal</a>
                        </div>
                        <!-- END: Modal Toggle -->
                        <!-- BEGIN: Modal Content -->
                        <div id="overlapping-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="px-5 py-10 modal-body">
                                        <div class="text-center">
                                            <div class="mb-5">Click button bellow to show overlapping modal!</div>
                                            <!-- BEGIN: Overlapping Modal Toggle -->
                                            <a href="javascript:;" data-toggle="modal" data-target="#next-overlapping-modal-preview" class="btn btn-primary">Show Overlapping Modal</a>
                                            <!-- END: Overlapping Modal Toggle -->
                                        </div>
                                        <!-- BEGIN: Overlapping Modal Content -->
                                        <div id="next-overlapping-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="text-center modal-body">
                                                        This is totally awesome overlapping modal!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Overlapping Modal Content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Modal Content -->
                    </div>
                    <div class="hidden source-code">
                        <button data-target="#copy-overlapping-modal" class="px-2 py-1 copy-code btn btn-outline-secondary">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="mt-3 overflow-y-auto rounded-md">
                            <pre id="copy-overlapping-modal" class="source-preview">
                                <code class="p-0 pt-8 pb-4 pl-5 -mt-10 -mb-10 text-xs rounded-md html">
                                    {{-- {{ \Hp::formatCode('
                                        <!-- BEGIN: Modal Toggle -->
                                        <div class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#overlapping-modal-preview" class="btn btn-primary">Show Modal</a>
                                        </div>
                                        <!-- END: Modal Toggle -->
                                        <!-- BEGIN: Modal Content -->
                                        <div id="overlapping-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="px-5 py-10 modal-body">
                                                        <div class="text-center">
                                                            <div class="mb-5">Click button bellow to show overlapping modal!</div>
                                                            <!-- BEGIN: Overlapping Modal Toggle -->
                                                            <a href="javascript:;" data-toggle="modal" data-target="#next-overlapping-modal-preview" class="btn btn-primary">Show Overlapping Modal</a>
                                                            <!-- END: Overlapping Modal Toggle -->
                                                        </div>
                                                        <!-- BEGIN: Overlapping Modal Content -->
                                                        <div id="next-overlapping-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="text-center modal-body">
                                                                        This is totally awesome overlapping modal!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END: Overlapping Modal Content -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Modal Content -->
                                    ') }} --}}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Overlapping Modal -->
            <!-- BEGIN: Header & Footer Modal -->
            <div class="mt-5 intro-y box">
                <div class="flex flex-col items-center p-5 border-b border-gray-200 sm:flex-row dark:border-dark-5">
                    <h2 class="mr-auto text-base font-medium">Header & Footer Modal</h2>
                    <div class="flex items-center w-full mt-3 sm:w-auto sm:ml-auto sm:mt-0">
                        <label class="ml-0 form-check-label sm:ml-2" for="show-example-7">Show example code</label>
                        <input id="show-example-7" data-target="#header-footer-modal" class="ml-3 mr-0 show-code form-check-switch" type="checkbox">
                    </div>
                </div>
                <div id="header-footer-modal" class="p-5">
                    <div class="preview">
                        <!-- BEGIN: Modal Toggle -->
                        <div class="text-center">
                            <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview" class="btn btn-primary">Show Modal</a>
                        </div>
                        <!-- END: Modal Toggle -->
                        <!-- BEGIN: Modal Content -->
                        <div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- BEGIN: Modal Header -->
                                    <div class="modal-header">
                                        <h2 class="mr-auto text-base font-medium">Broadcast Message</h2>
                                        <button class="hidden btn btn-outline-secondary sm:flex">
                                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs
                                        </button>
                                        <div class="dropdown sm:hidden">
                                            <a class="block w-5 h-5 dropdown-toggle" href="javascript:;" aria-expanded="false">
                                                <i data-feather="more-horizontal" class="w-5 h-5 text-gray-600 dark:text-gray-600"></i>
                                            </a>
                                            <div class="w-40 dropdown-menu">
                                                <div class="p-2 dropdown-menu__content box dark:bg-dark-1">
                                                    <a href="javascript:;" class="flex items-center p-2 transition duration-300 ease-in-out bg-white rounded-md dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2">
                                                        <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Modal Header -->
                                    <!-- BEGIN: Modal Body -->
                                    <div class="grid grid-cols-12 gap-4 modal-body gap-y-3">
                                        <div class="col-span-12 sm:col-span-6">
                                            <label for="modal-form-1" class="form-label">From</label>
                                            <input id="modal-form-1" type="text" class="form-control" placeholder="example@gmail.com">
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <label for="modal-form-2" class="form-label">To</label>
                                            <input id="modal-form-2" type="text" class="form-control" placeholder="example@gmail.com">
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <label for="modal-form-3" class="form-label">Subject</label>
                                            <input id="modal-form-3" type="text" class="form-control" placeholder="Important Meeting">
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <label for="modal-form-4" class="form-label">Has the Words</label>
                                            <input id="modal-form-4" type="text" class="form-control" placeholder="Job, Work, Documentation">
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <label for="modal-form-5" class="form-label">Doesn't Have</label>
                                            <input id="modal-form-5" type="text" class="form-control" placeholder="Job, Work, Documentation">
                                        </div>
                                        <div class="col-span-12 sm:col-span-6">
                                            <label for="modal-form-6" class="form-label">Size</label>
                                            <select id="modal-form-6" class="form-select">
                                                <option>10</option>
                                                <option>25</option>
                                                <option>35</option>
                                                <option>50</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- END: Modal Body -->
                                    <!-- BEGIN: Modal Footer -->
                                    <div class="text-right modal-footer">
                                        <button type="button" data-dismiss="modal" class="w-20 mr-1 btn btn-outline-secondary">Cancel</button>
                                        <button type="button" class="w-20 btn btn-primary">Send</button>
                                    </div>
                                    <!-- END: Modal Footer -->
                                </div>
                            </div>
                        </div>
                        <!-- END: Modal Content -->
                    </div>
                    <div class="hidden source-code">
                        <button data-target="#copy-header-footer-modal" class="px-2 py-1 copy-code btn btn-outline-secondary">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="mt-3 overflow-y-auto rounded-md">
                            <pre id="copy-header-footer-modal" class="source-preview">
                                <code class="p-0 pt-8 pb-4 pl-5 -mt-10 -mb-10 text-xs rounded-md html">
                                    {{-- {{ \Hp::formatCode('
                                        <!-- BEGIN: Modal Toggle -->
                                        <div class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview" class="btn btn-primary">Show Modal</a>
                                        </div>
                                        <!-- END: Modal Toggle -->
                                        <!-- BEGIN: Modal Content -->
                                        <div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- BEGIN: Modal Header -->
                                                    <div class="modal-header">
                                                        <h2 class="mr-auto text-base font-medium">Broadcast Message</h2>
                                                        <button class="hidden btn btn-outline-secondary sm:flex">
                                                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs
                                                        </button>
                                                        <div class="dropdown sm:hidden">
                                                            <a class="block w-5 h-5 dropdown-toggle" href="javascript:;" aria-expanded="false">
                                                                <i data-feather="more-horizontal" class="w-5 h-5 text-gray-600 dark:text-gray-600"></i>
                                                            </a>
                                                            <div class="w-40 dropdown-menu">
                                                                <div class="p-2 dropdown-menu__content box dark:bg-dark-1">
                                                                    <a href="javascript:;" class="flex items-center p-2 transition duration-300 ease-in-out bg-white rounded-md dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2">
                                                                        <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- END: Modal Header -->
                                                    <!-- BEGIN: Modal Body -->
                                                    <div class="grid grid-cols-12 gap-4 modal-body gap-y-3">
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-1" class="form-label">From</label>
                                                            <input id="modal-form-1" type="text" class="form-control" placeholder="example@gmail.com">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-2" class="form-label">To</label>
                                                            <input id="modal-form-2" type="text" class="form-control" placeholder="example@gmail.com">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-3" class="form-label">Subject</label>
                                                            <input id="modal-form-3" type="text" class="form-control" placeholder="Important Meeting">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-4" class="form-label">Has the Words</label>
                                                            <input id="modal-form-4" type="text" class="form-control" placeholder="Job, Work, Documentation">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-5" class="form-label">Doesn\'t Have</label>
                                                            <input id="modal-form-5" type="text" class="form-control" placeholder="Job, Work, Documentation">
                                                        </div>
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-6" class="form-label">Size</label>
                                                            <select id="modal-form-6" class="form-select">
                                                                <option>10</option>
                                                                <option>25</option>
                                                                <option>35</option>
                                                                <option>50</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- END: Modal Body -->
                                                    <!-- BEGIN: Modal Footer -->
                                                    <div class="text-right modal-footer">
                                                        <button type="button" data-dismiss="modal" class="w-20 mr-1 btn btn-outline-secondary">Cancel</button>
                                                        <button type="button" class="w-20 btn btn-primary">Send</button>
                                                    </div>
                                                    <!-- END: Modal Footer -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Modal Content -->
                                    ') }} --}}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Header & Footer Modal -->
            <!-- BEGIN: Delete Modal -->
            <div class="mt-5 intro-y box">
                <div class="flex flex-col items-center p-5 border-b border-gray-200 sm:flex-row dark:border-dark-5">
                    <h2 class="mr-auto text-base font-medium">Delete Modal</h2>
                    <div class="flex items-center w-full mt-3 sm:w-auto sm:ml-auto sm:mt-0">
                        <label class="ml-0 form-check-label sm:ml-2" for="show-example-8">Show example code</label>
                        <input id="show-example-8" data-target="#delete-modal" class="ml-3 mr-0 show-code form-check-switch" type="checkbox">
                    </div>
                </div>
                <div id="delete-modal" class="p-5">
                    <div class="preview">
                        <!-- BEGIN: Modal Toggle -->
                        <div class="text-center">
                            <a href="javascript:;" data-toggle="modal" data-target="#delete-modal-preview" class="btn btn-primary">Show Modal</a>
                        </div>
                        <!-- END: Modal Toggle -->
                        <!-- BEGIN: Modal Content -->
                        <div id="delete-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="p-0 modal-body">
                                        <div class="p-5 text-center">
                                            <i data-feather="x-circle" class="w-16 h-16 mx-auto mt-3 text-theme-6"></i>
                                            <div class="mt-5 text-3xl">Are you sure?</div>
                                            <div class="mt-2 text-gray-600">Do you really want to delete these records? <br>This process cannot be undone.</div>
                                        </div>
                                        <div class="px-5 pb-8 text-center">
                                            <button type="button" data-dismiss="modal" class="w-24 mr-1 btn btn-outline-secondary dark:border-dark-5 dark:text-gray-300">Cancel</button>
                                            <button type="button" class="w-24 btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Modal Content -->
                    </div>
                    <div class="hidden source-code">
                        <button data-target="#copy-delete-modal" class="px-2 py-1 copy-code btn btn-outline-secondary">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="mt-3 overflow-y-auto rounded-md">
                            <pre id="copy-delete-modal" class="source-preview">
                                <code class="p-0 pt-8 pb-4 pl-5 -mt-10 -mb-10 text-xs rounded-md html">
                                    {{-- {{ \Hp::formatCode('
                                        <!-- BEGIN: Modal Toggle -->
                                        <div class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#delete-modal-preview" class="btn btn-primary">Show Modal</a>
                                        </div>
                                        <!-- END: Modal Toggle -->
                                        <!-- BEGIN: Modal Content -->
                                        <div id="delete-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="p-0 modal-body">
                                                        <div class="p-5 text-center">
                                                            <i data-feather="x-circle" class="w-16 h-16 mx-auto mt-3 text-theme-6"></i>
                                                            <div class="mt-5 text-3xl">Are you sure?</div>
                                                            <div class="mt-2 text-gray-600">Do you really want to delete these records? <br>This process cannot be undone.</div>
                                                        </div>
                                                        <div class="px-5 pb-8 text-center">
                                                            <button type="button" data-dismiss="modal" class="w-24 mr-1 btn btn-outline-secondary dark:border-dark-5 dark:text-gray-300">Cancel</button>
                                                            <button type="button" class="w-24 btn btn-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Modal Content -->
                                    ') }} --}}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Delete Modal -->
            <!-- BEGIN: Success Modal -->
            <div class="mt-5 intro-y box">
                <div class="flex flex-col items-center p-5 border-b border-gray-200 sm:flex-row dark:border-dark-5">
                    <h2 class="mr-auto text-base font-medium">Success Modal</h2>
                    <div class="flex items-center w-full mt-3 sm:w-auto sm:ml-auto sm:mt-0">
                        <label class="ml-0 form-check-label sm:ml-2" for="show-example-9">Show example code</label>
                        <input id="show-example-9" data-target="#success-modal" class="ml-3 mr-0 show-code form-check-switch" type="checkbox">
                    </div>
                </div>
                <div id="success-modal" class="p-5">
                    <div class="preview">
                        <!-- BEGIN: Modal Toggle -->
                        <div class="text-center">
                            <a href="javascript:;" data-toggle="modal" data-target="#success-modal-preview" class="btn btn-primary">Show Modal</a>
                        </div>
                        <!-- END: Modal Toggle -->
                        <!-- BEGIN: Modal Content -->
                        <div id="success-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="p-0 modal-body">
                                        <div class="p-5 text-center">
                                            <i data-feather="check-circle" class="w-16 h-16 mx-auto mt-3 text-theme-9"></i>
                                            <div class="mt-5 text-3xl">Good job!</div>
                                            <div class="mt-2 text-gray-600">You clicked the button!</div>
                                        </div>
                                        <div class="px-5 pb-8 text-center">
                                            <button type="button" data-dismiss="modal" class="w-24 btn btn-primary">Ok</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Modal Content -->
                    </div>
                    <div class="hidden source-code">
                        <button data-target="#copy-success-modal" class="px-2 py-1 copy-code btn btn-outline-secondary">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="mt-3 overflow-y-auto rounded-md">
                            <pre id="copy-success-modal" class="source-preview">
                                <code class="p-0 pt-8 pb-4 pl-5 -mt-10 -mb-10 text-xs rounded-md html">
                                    {{-- {{ \Hp::formatCode('
                                        <!-- BEGIN: Modal Toggle -->
                                        <div class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#success-modal-preview" class="btn btn-primary">Show Modal</a>
                                        </div>
                                        <!-- END: Modal Toggle -->
                                        <!-- BEGIN: Modal Content -->
                                        <div id="success-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="p-0 modal-body">
                                                        <div class="p-5 text-center">
                                                            <i data-feather="check-circle" class="w-16 h-16 mx-auto mt-3 text-theme-9"></i>
                                                            <div class="mt-5 text-3xl">Good job!</div>
                                                            <div class="mt-2 text-gray-600">You clicked the button!</div>
                                                        </div>
                                                        <div class="px-5 pb-8 text-center">
                                                            <button type="button" data-dismiss="modal" class="w-24 btn btn-primary">Ok</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Modal Content -->
                                    ') }} --}}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Success Modal -->
            <!-- BEGIN: Tiny Slider Modal -->
            <div class="mt-5 intro-y box">
                <div class="flex flex-col items-center p-5 border-b border-gray-200 sm:flex-row dark:border-dark-5">
                    <h2 class="mr-auto text-base font-medium">Tiny Slider Modal</h2>
                    <div class="flex items-center w-full mt-3 sm:w-auto sm:ml-auto sm:mt-0">
                        <label class="ml-0 form-check-label sm:ml-2" for="show-example-10">Show example code</label>
                        <input id="show-example-10" data-target="#tiny-slider-modal" class="ml-3 mr-0 show-code form-check-switch" type="checkbox">
                    </div>
                </div>
                <div id="tiny-slider-modal" class="p-5">
                    <div class="preview">
                        <!-- BEGIN: Modal Toggle -->
                        <div class="text-center">
                            <a href="javascript:;" data-toggle="modal" data-target="#tiny-slider-modal-preview" class="btn btn-primary">Show Modal</a>
                        </div>
                        <!-- END: Modal Toggle -->
                        <!-- BEGIN: Modal Content -->
                        <div id="tiny-slider-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="mx-6">
                                            <div class="center-mode">
                                                <div class="h-56 px-2">
                                                    <div class="h-full overflow-hidden rounded-md image-fit">
                                                        <img alt="Rubick Tailwind HTML Admin Template" src="{{ asset('dist/images/' . $fakers[0]['images'][0]) }}" />
                                                    </div>
                                                </div>
                                                <div class="h-56 px-2">
                                                    <div class="h-full overflow-hidden rounded-md image-fit">
                                                        <img alt="Rubick Tailwind HTML Admin Template" src="{{ asset('dist/images/' . $fakers[0]['images'][1]) }}" />
                                                    </div>
                                                </div>
                                                <div class="h-56 px-2">
                                                    <div class="h-full overflow-hidden rounded-md image-fit">
                                                        <img alt="Rubick Tailwind HTML Admin Template" src="{{ asset('dist/images/' . $fakers[0]['images'][2]) }}" />
                                                    </div>
                                                </div>
                                                <div class="h-56 px-2">
                                                    <div class="h-full overflow-hidden rounded-md image-fit">
                                                        <img alt="Rubick Tailwind HTML Admin Template" src="{{ asset('dist/images/' . $fakers[0]['images'][3]) }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Modal Content -->
                    </div>
                    <div class="hidden source-code">
                        <button data-target="#copy-tiny-slider-modal" class="px-2 py-1 copy-code btn btn-outline-secondary">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="mt-3 overflow-y-auto rounded-md">
                            <pre id="copy-tiny-slider-modal" class="source-preview">
                                <code class="p-0 pt-8 pb-4 pl-5 -mt-10 -mb-10 text-xs rounded-md html">
                                    {{-- {{ \Hp::formatCode('
                                        <!-- BEGIN: Modal Toggle -->
                                        <div class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#tiny-slider-modal-preview" class="btn btn-primary">Show Modal</a>
                                        </div>
                                        <!-- END: Modal Toggle -->
                                        <!-- BEGIN: Modal Content -->
                                        <div id="tiny-slider-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="mx-6">
                                                            <div class="center-mode">
                                                                <div class="h-56 px-2">
                                                                    <div class="h-full overflow-hidden rounded-md image-fit">
                                                                        <img alt="Rubick Tailwind HTML Admin Template" src="' . asset('dist/images/' . $fakers[0]['images'][0]) . '" />
                                                                    </div>
                                                                </div>
                                                                <div class="h-56 px-2">
                                                                    <div class="h-full overflow-hidden rounded-md image-fit">
                                                                        <img alt="Rubick Tailwind HTML Admin Template" src="' . asset('dist/images/' . $fakers[0]['images'][1]) . '" />
                                                                    </div>
                                                                </div>
                                                                <div class="h-56 px-2">
                                                                    <div class="h-full overflow-hidden rounded-md image-fit">
                                                                        <img alt="Rubick Tailwind HTML Admin Template" src="' . asset('dist/images/' . $fakers[0]['images'][2]) . '" />
                                                                    </div>
                                                                </div>
                                                                <div class="h-56 px-2">
                                                                    <div class="h-full overflow-hidden rounded-md image-fit">
                                                                        <img alt="Rubick Tailwind HTML Admin Template" src="' . asset('dist/images/' . $fakers[0]['images'][3]) . '" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END: Modal Content -->
                                    ') }} --}}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Tiny Slider Modal -->
        </div>
    </div>
@endsection
