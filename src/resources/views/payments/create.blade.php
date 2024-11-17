<!-- resources/views/payments/create.blade.php -->

<form action="{{ route('payments.store') }}" method="POST">
    @csrf
    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="{{ config('services.stripe.key') }}"
        data-amount="{{ $reservation->amount * 100 }}"
        data-name="Reservation Payment"
        data-description="Payment for reservation"
        data-currency="jpy"
        data-locale="auto">
    </script>
    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
    <input type="hidden" name="amount" value="{{ $reservation->amount }}">
</form>
