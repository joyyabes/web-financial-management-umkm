@extends('template.layout')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<h1 class="text-2xl font-semibold mb-4">Edit Transactions</h1>
<div class="bg-white rounded-xl p-4 shadow">

    <form id="transactionForm" class=" p-6 space-y-4">
        <input type="hidden" name="id" id="transactionId" value="{{ $id }}">

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
            <a href="{{ url('/transaction') }}" class="bg-red-500 text-white px-5 py-2 rounded-lg hover:bg-red-300 transition">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">Simpan</button>
        </div>
    </form>


    @endsection

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        const form = document.getElementById('transactionForm');
        const transactionId = form.id.value;

        axios.get(`http://127.0.0.1:8000/api/transactions/${transactionId}`)
            .then(res => {
                const data = res.data;

                form.id.value = data.id;
                form.transaction_date.value = data.transaction_date;
                form.type.value = data.type;
                form.amount.value = data.amount;
                form.description.value = data.description;
                form.category_id.value = data.category_id;
            })
            .catch(err => {
                alert('Gagal mengambil data');
                console.error(err);
            });

        document.getElementById('transactionForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const id = form.id.value;

            const data = {
                transaction_date: form.transaction_date.value,
                type: form.type.value,
                category_id: parseInt(form.category_id.value),
                amount: parseInt(form.amount.value),
                description: form.description.value
            };

            axios.put(`http://127.0.0.1:8000/api/transactions/${id}`, data, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }
                })
                .then(res => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil diupdate!',
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