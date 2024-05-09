<x-app-layout>
    <ul id="tabs-swipe-demo" class="tabs">
        <li class="tab col s3 white"><a class="active indigo-text text-darken-4" href="#test-swipe-1"><b>PERFIL</b></a></li>
        <li class="tab col s3"><a class="indigo-text text-darken-4" href="#test-swipe-2"><b>SENHA</b></a></li>
        <li class="tab col s3"><a class="indigo-text text-darken-4" href="#test-swipe-3"><b>CONTA</b></a></li>
    </ul>
    <div id="test-swipe-1" class="col s12">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="test-swipe-2" class="col s12">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="test-swipe-3" class="col s12">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>