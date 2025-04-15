@extends('template.layout')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<h1 class="text-2xl font-semibold mb-4">Transactions</h1>
<div class="bg-white rounded-xl p-4 shadow">
    <table id="userTable" class="display">
        <thead>
            <tr>
                <th>Jenis</th>
                <th>Tanggal</th>
                <th>Type</th>
                <th>Jumlah</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
    @endsection

    @push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                processing: true,
                serverSide: false,
                ajax: '/get_transaction',
                columns: [{
                        data: 'description'
                    },
                    {
                        data: 'transaction_date'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            if (row.type === 'expense') {
                                return `
                    <span class="bg-red-500 text-white px-5 py-2 rounded-lg">Expense</span>
                    `;
                            } else if (row.type === 'income') {
                                return `
                    <span class="bg-green-500 text-white px-5 py-2 rounded-lg">Income</span>
                    `;
                            }

                        }
                    },
                    {
                        data: 'amount',
                        render: function(data, type, row) {
                            return new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 0
                            }).format(data);
                        }
                    },
                    {
                        data: 'category.name'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                <a href="{{ url('/edit_transaction/${row.id}') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">Edit</a>   
                <button class="bg-red-500 text-white px-5 py-2 rounded-lg btn-delete" data-id="${row.id}">Hapus</button>
                `;
                        }
                    }
                ]
            });


            $('#userTable').on('click', '.btn-delete', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Yakin ingin menghapus data ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`http://127.0.0.1:8000/api/transactions/${id}`)
                            .then(() => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Data berhasil dihapus.',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                                $('#userTable').DataTable().ajax.reload();
                            })
                            .catch(err => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat menghapus data.'
                                });
                            });
                    }
                });
            });

        });
    </script>

    @endpush