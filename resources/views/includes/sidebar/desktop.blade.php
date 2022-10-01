<div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
    <div class="flex flex-col flex-1 min-h-0 bg-gray-800">
      <div class="flex items-center flex-shrink-0 h-16 px-4 bg-gray-900">
        <img class="w-auto h-8" src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg" alt="Workflow">
      </div>
      <div class="flex flex-col flex-1 overflow-y-auto">
        <nav class="flex-1 px-2 py-4 space-y-1">

          <x-sidebar-menu-item link="dashboard">
            <x-heroicon-s-home class="flex-shrink-0 w-6 h-6 mr-3 text-gray-400 group-hover:text-gray-300"/>
            Dashboard {{ Auth::user()->role }}
          </x-sidebar-menu-item>

          @role('admin')
          @include('includes.sidebar._admin')
          @endrole

          @role('cashier')
          @include('includes.sidebar._cashier')
          @endrole


          @role('approving_officer')
          @include('includes.sidebar._approver')
          @endrole
         
        </nav>
      </div>
    </div>
  </div>
  