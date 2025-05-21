@extends('admin.layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Berita Box -->
                <a href="{{ route('admin.berita.index') }}" class="block">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Berita</h3>
                                    <p class="text-sm text-gray-500">Kelola berita sekolah</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Pengumuman Box -->
                <a href="{{ route('admin.events.index') }}" class="block">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Pengumuman</h3>
                                    <p class="text-sm text-gray-500">Kelola pengumuman sekolah</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Informasi Pendaftaran Box -->
                <a href="{{ route('admin.pendaftaran.index') }}" class="block">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Informasi Pendaftaran</h3>
                                    <p class="text-sm text-gray-500">Kelola informasi pendaftaran</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Ekstrakurikuler Box -->
                <a href="{{ route('admin.ekstrakurikuler.index') }}" class="block">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Ekstrakurikuler</h3>
                                    <p class="text-sm text-gray-500">Kelola ekstrakurikuler sekolah</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection