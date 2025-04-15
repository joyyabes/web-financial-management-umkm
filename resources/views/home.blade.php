@extends('template.layout')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
  <div class="bg-white rounded-xl p-4 shadow">
    <h2 class="text-lg font-medium">Total Data Transaction</h2>
    <p class="text-2xl font-bold mt-2" id="totalTransaction"></p>
  </div>
  <div class="bg-white rounded-xl p-4 shadow">
    <h2 class="text-lg font-medium">Cashflow</h2>
    <p class="text-2xl font-bold mt-2" id="totalCashflow"></p>
  </div>
</div>

<div class="bg-white rounded-xl p-4 shadow">
  <h2 class="text-lg font-semibold mb-2">Recent Transaction</h2>
  <table id="latestTransactionTable" class="w-full text-left table-auto">
    <thead>
      <tr class="bg-gray-100">
        <th class="p-2">Jenis</th>
        <th class="p-2">Tanggal</th>
        <th class="p-2">Type</th>
        <th class="p-2">Jumlah</th>
        <th class="p-2">Kategori</th>
      </tr>
    </thead>
    <tbody id="latestTransactionBody">
    </tbody>
  </table>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
  axios.get('http://127.0.0.1:8000/api/transactions')
    .then(response => {
      const transactions = response.data.transactions_from_db || [];

      const totalData = transactions.length;

      const totalAmount = transactions.reduce((sum, trx) => {
        return sum + parseFloat(trx.amount);
      }, 0);

      document.getElementById('totalTransaction').innerText = totalData.toLocaleString('id-ID');
      document.getElementById('totalCashflow').innerText = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
      }).format(totalAmount);
    })
    .catch(error => {
      console.error('Gagal ambil data:', error);
    });

  axios.get('http://127.0.0.1:8000/api/transactions')
    .then(response => {
      const allData = response.data.transactions_from_db;

      const latestThree = allData
        .sort((a, b) => new Date(b.transaction_date) - new Date(a.transaction_date))
        .slice(0, 3);

      const tbody = document.getElementById('latestTransactionBody');
      tbody.innerHTML = '';

      latestThree.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
              <tr>
             <td class="p-2">${item.description}</td>
                  <td class="p-2">${item.transaction_date}</td>
                  <td class="p-2">${item.type}</td>
                   <td class="p-2">
                      ${new Intl.NumberFormat('id-ID', {
                          style: 'currency',
                          currency: 'IDR',
                          minimumFractionDigits: 0
                      }).format(item.amount)}
                  </td>
                  <td class="p-2">${item.category.name}</td>
            </tr>
              `;

        tbody.appendChild(row);
      });
    })
    .catch(error => {
      console.error('Gagal ambil data:', error);
      document.getElementById('latestTransactionBody').innerHTML = `
              <tr><td colspan="3" class="text-center text-red-600 py-3">Gagal memuat data</td></tr>
          `;
    });
</script>
@endpush