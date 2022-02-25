@extends('layouts.app')
@section('content')
<div class="flex justify-center ... text-sm">
    <div class="">
        <div class="">
            <input type="hidden" name="account_no" id="account_no" value="{{$accnt_no}}">
            <input type="hidden" name="user-account" id="user-account" value="{{$id}}">
            <div class="bill-container p-6 w-96 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Power Bill</h5>
                </a>
                <hr>
                <p class="mb-2 text-sm font-bold tracking-tight text-gray-900 dark:text-white">TOTAL UNPAID BILLS: <span class="total-arrears"></span></p>
                <hr>
                <div>
                    <label for="account_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Bill Month:</label>
                    <input type="month" name="bill_period" id="bill_period" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    <button class="show_bill mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="{{Auth::user()->id}}" id="show_bill">Show Bill</button>
                </div>
                <div class="card-data"></div>
            </div>
        </div>
    </div>
</div>
<!--Account information modal -->
<div id="authentication-modal" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0">
    <div class="relative px-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex justify-end p-2">
            </div>
            <form class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8" action="#">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Account Information</h3>
                <hr>
                <div>
                    <label for="account_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Account Name:</label>
                    <div class="account-name-container">
                        <i class='fa fa-check icon icon-check'></i>
                        <i class='fa fa-times icon icon-wrong'></i>
                        <i class='fa fa-exclamation icon icon-ex'></i>
                        <input type="text" placeholder="ex: John Doe" name="full_name" id="full_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Account Number:</label>
                    <div class="account-no-container">
                        <i class='fa fa-check icon icon-check'></i>
                        <i class='fa fa-times icon icon-wrong'></i>
                        <i class='fa fa-exclamation icon icon-ex'></i>
                        <input type="text" placeholder="ex: 4343111111" name="account_no" id="account_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                </div>
                <button type="button" class="consumer_save w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                <button class="logout-account w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                href="{{ route('logout') }}" 
                onclick="event.preventDefault();
                document.getElementById('logout-form')
                .submit();">
                {{ __('Logout') }}
            </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </form>
        </div>
    </div>
</div> 
<!--change password modal -->
<div id="change-pass-modal" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0">
    <div class="relative px-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex justify-end p-2">
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="change-pass-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <form class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8" action="#">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Change Password</h3>
                <hr>
                <div>
                    <label for="account_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Current Password:</label>
                    <div class="account-current-pass-container">
                    <i class='fa fa-check icon icon-check'></i>
                    <i class='fa fa-times icon icon-wrong'></i>
                    <i class='fa fa-exclamation icon icon-ex'></i>
                    <input type="password" name="current_pass" id="current_pass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">New Password:</label>
                    <div class="account-new-pass-container">
                        <i class='fa fa-check icon icon-check'></i>
                        <i class='fa fa-times icon icon-wrong'></i>
                        <i class='fa fa-exclamation icon icon-ex'></i>
                        <input type="password" name="n_pass" id="n_pass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirm New Password:</label>
                    <div class="account-con-new-pass-container">
                        <i class='fa fa-check icon icon-check'></i>
                        <i class='fa fa-times icon icon-wrong'></i>
                        <i class='fa fa-exclamation icon icon-ex'></i>
                        <input type="password" name="c_n_pass" id="c_n_pass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                </div>
                <button type="button" class="change-password-user w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
