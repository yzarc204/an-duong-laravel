@extends('layouts.default')

@section('content')
    <section class="mb-12 bg-white p-8 rounded-xl shadow-lg">
        <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Biểu đồ đường huyết</h2>
            <a href="{{ route('record.create') }}"
                class="bg-primary text-secondary py-2 px-4 rounded-lg hover:bg-secondary hover:text-white text-700 transition duration-200 font-semibold">Thêm
                lịch sử</a>
        </div>
        <canvas id="chart" class="w-full" height="400"></canvas>
    </section>

    <section class="bg-white p-8 rounded-xl shadow-lg" id="recordTable">
        <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Lịch sử đo đường huyết</h2>
            <a href="{{ route('record.create') }}"
                class="bg-primary text-secondary py-2 px-4 rounded-lg hover:bg-secondary hover:text-white text-700 transition duration-200 font-semibold">Thêm
                lịch sử</a>
        </div>

        <!-- Filters -->
        <div class="mb-6 flex flex-col lg:flex-row gap-4 gap-y-6">
            <div class="flex-1">
                <label for="filterDateFrom" class="block text-sm font-semibold text-gray-700 mb-2">Ngày bắt đầu</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-5">
                        <i class="far fa-calendar"></i>
                    </span>
                    <input type="date" id="filterDateFrom"
                        class="pl-10 pr-5 block w-full rounded-lg border border-gray-200 bg-gray-50 py-3 text-gray-900 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary focus:outline-none">
                </div>
            </div>
            <div class="flex-1">
                <label for="filterDateTo" class="block text-sm font-semibold text-gray-700 mb-2">Ngày kết thúc</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-5">
                        <i class="far fa-calendar"></i>
                    </span>
                    <input type="date" id="filterDateTo"
                        class="pl-10 pr-5 block w-full rounded-lg border border-gray-200 bg-gray-50 py-3 text-gray-900 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary focus:outline-none">
                </div>
            </div>
            <div class="flex-1">
                <label for="filterStatus" class="block text-sm font-semibold text-gray-700 mb-2">Trạng thái</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-5">
                        <i class="fas fa-arrows-up-down"></i>
                    </span>
                    <select type="date" id="filterStatus"
                        class="pl-10 pr-5 block w-full rounded-lg border border-gray-200 bg-gray-50 py-3 text-gray-900 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary focus:outline-none">
                        <option value="">Tất cả</option>
                        @foreach ($statuses as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex-shrink-0 mt-auto">
                <div class="flex flex-row gap-x-4 justify-between">
                    <button id="filterButton"
                        class="flex-1 lg:flex-none bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200 font-semibold cursor-pointer">Lọc</button>
                    <button id="clearFilterButton"
                        class="flex-1 lg:flex-none bg-red-500 text-white py-3 px-6 rounded-lg hover:bg-red-600 transition duration-200 font-semibold cursor-pointer">Xoá
                        bộ lọc</button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-green-300/10">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-500 uppercase tracking-wider">
                            Thời gian đo
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-500 uppercase tracking-wider">
                            Thời điểm đo
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-500 uppercase tracking-wider">
                            Đường huyết (mg/dl)
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-500 uppercase tracking-wider">
                            Cân nặng (kg)
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-500 uppercase tracking-wider">
                            Trạng thái
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($records as $record)
                        <tr class="bg-white hover:bg-primary/5 transition duration-200 align-middle">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $record->measure_at->format('H:i d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $record->measurement_point->label() }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $record->glucose }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $record->weight }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($record->status === App\Enums\GlucoseStatus::LOW)
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Thấp</span>
                                @endif
                                @if ($record->status === App\Enums\GlucoseStatus::NORMAL)
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Bình
                                        thường</span>
                                @endif
                                @if ($record->status === App\Enums\GlucoseStatus::HIGH)
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Cao</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-between items-center">
            @if (!$records->onFirstPage())
                <a href="{{ $records->previousPageUrl() }}"
                    class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">Trang
                    trước</a>
            @else
                <span
                    class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200 opacity-50 cursor-not-allowed">Trang
                    trước</span>
            @endif
            <span class="text-sm text-gray-700">Trang {{ $records->currentPage() }} / {{ $records->lastPage() }}</span>
            @if ($records->hasMorePages())
                <a href="{{ $records->nextPageUrl() ?? '#' }}" disabled
                    class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200 disabled:opacity-50">Trang
                    sau</a>
            @else
                <span
                    class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200 opacity-50 cursor-not-allowed">Trang
                    sau</span>
            @endif
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('vendors/chart.js/chart.umd.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart.js') }}"></script>
    <script>
        const records = @json($chartRecords);
    </script>
    <script src="{{ asset('assets/js/glucose-record.js') }}"></script>
@endsection
