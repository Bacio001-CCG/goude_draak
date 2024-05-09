@extends('layouts.app')
@section('content')

<div
    class="flex  flex-col justify-center px-6 py-12 lg:px-8  bg-white absolute top-1/2 -translate-y-1/2 -translate-x-1/2 left-1/2 w-[30rem] rounded shadow-lg">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
            alt="Your Company">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">{{__('Register a new
            account')}}</h2>
    </div>

    @if($errors->any())
    <h1 class="text-red-500 text-center">

        {{$errors->first()}}

    </h1>
    @endif

    <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{route('register.post')}}" method="POST">

            @csrf
            @method('POST')

            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">{{__('Email
                    address')}}</label>
                <div class="mt-2">
                    <input id="email" name="email" type="email" required
                        class="@error('email') border-red-500 @endif block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password"
                        class="block text-sm font-medium leading-6 text-gray-900">{{__('Password')}}</label>
                </div>
                <div class="mt-2">
                    <input id="password" name="password" type="password" required
                        class="@error('password') border-red-500 @endif block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password_confirmation "
                        class="block text-sm font-medium leading-6 text-gray-900">{{__('Confirm Password')}}</label>
                </div>
                <div class="mt-2">
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="@error('password_confirmation') border-red-500 @endif block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 p-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{__('Sign
                    up')}}</button>
            </div>


        </form>

        <p class="mt-10 text-center text-sm text-gray-500">
            {{__('Already have an account?')}}
            <a href="{{route('login')}}"
                class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">{{__('Login now!')}}</a>
        </p>
    </div>
</div>

@endsection