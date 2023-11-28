@extends('layouts.app')
@section('content')
<div class="subscription py-4">
  <div class="container d-flex justify-content-center mt-3">
    <div class="w-50">
      <h1 class="text-center">有料会員登録</h1>
      <div class="card my-4">
        <div class="card-header text-center">
          有料会員特典
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">・お店のネット予約が可能</li>
          <li class="list-group-item">・お店をお好きなだけお気に入りに追加可能</li>
          <li class="list-group-item">・レビューを投稿可能</li>
          <li class="list-group-item">・月額たったの300円</li>
          <li class="list-group-item">・お支払いはクレジットカードを登録するだけ</li>
        </ul>
      </div>

      <hr class="mb-4">

      <form id="setup-form">
        <input id="card-holder-name" type="text" placeholder="カード名義人">
        <div id="card-element"></div>
        <button id="card-button" data-secret="{{$intent->client_secret}}" class="btn btn-primary bg_main w-100">サブスクリプション</button>
      </form>

    </div>
  </div>
</div>

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
  const stripe = Stripe('pk_test_51OHLVEKhH49tdTK43Vplg03etoeJEcbmp5B7hCd4Idlz4IUSCneTU1IzZrKUb3nEaGFFauPuqd5sva2TmulcyNtO00oeNKflt2');
  const elements = stripe.elements();
  const cardElement = elements.create('card');
  cardElement.mount('#card-element');

  const cardHolderName = document.getElementById('card-holder-name');
  const cardButton = document.getElementById('card-button');
  const clientSecret = cardButton.dataset.secret;

  cardButton.addEventListener('click', async (e) => {
    e.preventDefault();
    const {
      setupIntent,
      error
    } = await stripe.confirmCardSetup(
      clientSecret, {
        payment_method: {
          card: cardElement,
          billing_details: {
            name: cardHolderName.value
          }
        }
      });

    if (error) {
      // Display "error.message" to the user...
      console.log(error);
    } else {
      // The card has been verified successfully...
      console.log(setupIntent)
    }
  });
</script>
@endpush
@endsection