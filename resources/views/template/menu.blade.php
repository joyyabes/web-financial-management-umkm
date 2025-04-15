<aside id="sidebar" class="fixed z-20 top-0 left-0 md:static w-64 h-screen bg-white shadow-lg transform md:translate-x-0 -translate-x-full transition-transform duration-200 ease-in-out md:block">
  <div class="p-6 font-bold text-lg border-b hidden md:block">Financial Management UMKM</div>
  <nav class="p-4 space-y-2">
    <a href="{{ url('/') }}" class="block px-4 py-2 rounded {{ $page==='dashboard' ? 'bg-[#2563eb] text-white' : 'hover:bg-gray-200' }}">Dashboard</a>
    <a href="{{ url('/transaction') }}" class="block px-4 py-2 rounded {{ $page==='transaction' ? 'bg-[#2563eb] text-white' : 'hover:bg-gray-200' }}">Transactions</a>
    <a href="{{ url('/new_transaction') }}" class="block px-4 py-2 rounded {{ $page==='new_transaction' ? 'bg-[#2563eb] text-white' : 'hover:bg-gray-200' }}">New Transactions</a>
  </nav>
</aside>