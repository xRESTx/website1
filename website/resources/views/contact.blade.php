@extends('layouts.app')

@section('title', 'Contact form')

@section('content')
    <section class="space-y-6">
        <h2 class="text-3xl font-bold text-gray-100">Contact me</h2>
        @if ($errors->any())
            <x-alert type="error" :messages="$errors->all()" />
        @endif

        @if (session('success'))
            <x-alert type="success" :messages="session('success')" :timeout="3000" />
        @endif
        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6 bg-gray-800 p-6 rounded-lg shadow-md max-w-xl mx-auto">
                @csrf

            <x-form.input name="fullname" fieldLabel="Full Name"/>
            <x-form.input name="email" fieldLabel="E-mail" type="email"/>

            <x-form.select name="age" fieldLabel="Age" :options="[
                '18-25' => '18-25',
                '26-35' => '26-35',
                '36-45' => '36-45',
                '46+' => '46+'
            ]" required />

            <x-form.textarea name="message" fieldLabel="Text message"/>

            <div class="flex justify-between">
                <x-form.button type="submit" fieldLabel="Send" />
                <x-form.button type="reset" fieldLabel="Clear" />
            </div>
        </form>
    </section>
@endsection
