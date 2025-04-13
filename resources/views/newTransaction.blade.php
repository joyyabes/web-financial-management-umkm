@extends('template.layout')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<h1 class="text-2xl font-semibold mb-4">New Transactions</h1>
<div class="bg-white rounded-xl p-4 shadow">

    <form id="transactionForm" class=" p-6 space-y-4">
        <input type="hidden" name="id" value="">

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Transaksi</label>
            <input type="date" name="transaction_date" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Transaksi</label>
            <select name="type" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                <option value="income">Income</option>
                <option value="expense" selected>Expense</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <select name="category_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                <option value="1">Penjualan Produk</option>
                <option value="2">Biaya Operasional</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
            <input type="number" name="amount" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <input type="text" name="description" placeholder="Deskripsi" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300" required>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">Simpan</button>
        </div>
    </form>


    @endsection

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        document.getElementById('transactionForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;

            axios.post('http://127.0.0.1:8000/api/transactions', {
                    transaction_date: form.transaction_date.value,
                    type: form.type.value,
                    category_id: parseInt(form.category_id.value),
                    amount: parseInt(form.amount.value),
                    description: form.description.value
                })
                .then(res => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil ditambahkan!',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '/transaction';
                    });
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menyimpan data.'
                    });
                });
        });
    </script>
    @endpush