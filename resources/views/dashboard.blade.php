<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden">
                <div class="flex justify-center bg-gray-100 py-10 p-14">
                    <!---== First Stats Container ====--->
                    <div class="container mx-auto pr-4">
                        <div class="w-72 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
                            <div class="h-20 bg-red-400 flex items-center justify-between">
                                <p class="mr-0 text-white text-lg pl-5 px-2">المستخدمين</p>
                            </div>
                            <div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
                                <p>إجمالي</p>
                            </div>
                            <p class="py-4 text-3xl mr-5 px-2">{{\App\Models\User::where('name','!=','admin')->count()}}</p>
                            <!-- <hr > -->
                        </div>
                    </div>
                    <!---== First Stats Container ====--->

                    <!---== Second Stats Container ====--->
                    <div class="container mx-auto pr-4">
                        <div class="w-72 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
                            <div class="h-20 bg-blue-500 flex items-center justify-between">
                                <p class="mr-0 text-white text-lg pl-5 px-2">عدد البيوت</p>
                            </div>
                            <div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
                                <p>إجمالي</p>
                            </div>
                            <p class="py-4 text-3xl mr-5 px-2">{{\App\Models\User::has('houses')->count()}}</p>
                            <!-- <hr > -->
                        </div>
                    </div>
                    <!---== Second Stats Container ====--->

                    <!---== Third Stats Container ====--->

                    <!---== Third Stats Container ====--->

                    <!---== Fourth Stats Container ====--->
                    <div class="container mx-auto">
                        <div class="w-72 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
                            <div class="h-20 bg-purple-900 flex items-center justify-between">
                                <p class="mr-0 text-white text-lg pl-5 px-2 ">عدد المشتركين</p>
                            </div>
                            <div class="flex justify-between pt-6 px-5 mb-2 text-sm text-gray-600">
                                <p>إجمالي</p>
                            </div>
                            <p class="py-4 text-3xl mr-5 px-2">{{\App\Models\User::has('houses')->count()}}</p>
                            <!-- <hr > -->
                        </div>
                    </div>
                    <!---== Fourth Stats Container ====--->
                </div>
                <!---===================== FIRST ROW CONTAINING THE  STATS CARD ENDS HERE =============================-->

                <!------===================== SECOND ROW CONTAINING THE TABLE STATS STARTS HERE =============================-->
                <div class="flex justify-center bg-gray-100 py-10 p-5">
                    <!--==== frist div begins here ====--->
                    <div class="container mr-5 ml-2 mx-auto bg-white shadow-xl">
                        <div class="w-11/12 mx-auto">
                            <a href="{{ route('export-users') }}" class="btn btn-secondary pt-">Export</a>

                            <div class="bg-white my-6">

                                <table class="text-left w-full border-collapse pt-4"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                                    <thead>
                                    <tr>
                                        <th class="py-4 px-6 bg-purple-400 font-bold uppercase text-sm text-white border-b border-grey-light">رقم</th>

                                        <th class="py-4 px-6 bg-purple-400 font-bold uppercase text-sm text-white border-b border-grey-light">الإسم</th>
                                        <th class="py-4 px-6 text-center bg-purple-400 font-bold uppercase text-sm text-white border-b border-grey-light">البريد الإلكتروني</th>
                                        <th class="py-4 px-6 text-center bg-purple-400 font-bold uppercase text-sm text-white border-b border-grey-light">عدد البيوت</th>
                                        <th class="py-4 px-6 text-center bg-purple-400 font-bold uppercase text-sm text-white border-b border-grey-light">عمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i = 0 )

                                    @foreach($users as $user)
                                        <tr class="hover:bg-grey-lighter">
                                            <td class="py-4 px-6 border-b border-grey-light">{{++$i}}</td>


                                            <td class="py-4 px-6 border-b border-grey-light">{{$user->name}}</td>
                                            <td class="py-4 px-6 text-center border-b border-grey-light">
                                                {{$user->email}}</td>
                                            <td class="py-4 px-6 text-center border-b border-grey-light">{{$user->has('houses')->count()}}</td>
                                            <td>
                                                <a href="{{route('user.delete',$user->id)}}" class="btn btn-danger">Delete</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--==== frist div ends here ====--->

                    <!--==== Second div begins here ====--->
                    <!--==== Second div ends here ====--->


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
