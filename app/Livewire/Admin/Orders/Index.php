<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Title('All products')]
    #[Layout('admin.layouts.default')]
    public function render()
    {
        return view('admin.orders.index', ["orders" => Order::paginate(10)]);
    }

    public function updateOrderStatus($orderId, $status)
    {
        $order = Order::find($orderId);
        $order->status = $status;
        $order->save();

        // Optional: Show a notification
        session()->flash('success', "Order status of order id {$orderId} updated successfully to {$order->status}");
    }
}
