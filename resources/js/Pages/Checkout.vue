<script setup lang="ts">
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, useForm} from '@inertiajs/vue3';
    import {computed, onMounted, ref, toRefs,defineProps} from 'vue';
   
   

    
   import {Iproduct, useCart } from '@/store/Cart';
   import { storeToRefs } from 'pinia';

   const cartStore = useCart();
   const {cartBasket} = storeToRefs(cartStore);

   const props = defineProps({intent:Object,order:Object});
   const {intent,order} = toRefs(props);

   let stripe:any=null;
   let elements:any = null;
   let card:any = null;
   let form:any = null;
   const isProcessing = ref(false);
   let data = useForm({payment_intent:null});

    // remove from cart method
    function removeFromCart(_id:number){
        cartStore.removeFromCart(_id); 
    }

    // calculate total products
    const total = computed<number>(():number=>{
        const totalAmount=ref(0);
        cartBasket.value.map((product:Iproduct)=>{
            totalAmount.value+=product.price;
        });
        return (Number(totalAmount.value)>0)?Number(totalAmount.value.toFixed(2)):0;
    });

    function totalWithoutDot():number{
        const num=total.value.toString().split('.').join();
        return Number(num);
    }


    onMounted(()=>{
        // Sign in to see examples prefilled with your key.
        stripe = Stripe("pk_test_51PXedMJHw4z8WsrBArlzPHfEC6vNddyHU84jPJnCFje7zXwtsQaKQepj16IH08LX8UFlGXCe4sAHRCoFeWirgTdV00bRgQmCTe");
        elements = stripe.elements();
        var style = {
        base: {
            color: "#32325d",
            fontFamily: 'Arial, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
            "::placeholder": {
            color: "#32325d"
            }
        },
        invalid: {
            fontFamily: 'Arial, sans-serif',
            color: "#fa755a",
            iconColor: "#fa755a"
        }
        };

        card = elements.create("card", { style: style });
        // Stripe injects an iframe into the DOM
        card.mount("#card-element");
        card.on("loaderror", function (event) {
         // Listen for load errors, handling any errors using your own observability tooling.
        });

        card.on("change", function (event) {
            // Disable the Pay button if there are no card details in the Element
            document.querySelector("button").disabled = event.empty;
            document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
        });

        form = document.getElementById("payment-form");
        form.addEventListener("submit", function(event) {
        event.preventDefault();
        // Complete payment when the submit button is clicked
        payWithCard(stripe,card,intent?.value?.client_secret);


        });

        // store cart in db upon entry
        // setTimeout(() => {
        //     const _dt = useForm({
        //         total:totalWithoutDot(),
        //         total_decimal:total,
        //         items:cartBasket.value
        //     })
        //     _dt.post('/checkout');
        // },10);

    });

// prompt the user to enter authentication details without leaving your page.
const payWithCard =(stripe, card, clientSecret)=>{
  loading(true);
  stripe
    .confirmCardPayment(clientSecret, {
      payment_method: {
        card: card
      }
    })
    .then(function(result) {
      if (result.error) {
        // Show error to your customer
        console.log(result.error.message);
        showError(result.error.message);
      } else {
        // The payment succeeded!
        console.log(result.paymentIntent.id);
        orderComplete(result.paymentIntent.id);
      }
    });
};

/* ------- UI helpers ------- */

// Shows a success message when the payment is complete
const orderComplete = (paymentIntentId)=>{
    data.payment_intent=paymentIntentId;
    loading(false);
    data.put('/checkout');
};

// Show the customer the error from Stripe if their card fails to charge
const showError = (errorMsgText)=>{
  loading(false);
  var errorMsg = document.querySelector("#card-error");
  errorMsg.textContent = errorMsgText;
  setTimeout(function() {
    errorMsg.textContent = "";
  }, 4000);
};

// Show a spinner on payment submission
const loading = (isLoading)=>{
  if (isLoading) {
    // Disable the button and show a spinner
    document.querySelector("button").disabled = true;
    isProcessing.value=true;
  } else {
    document.querySelector("button").disabled = false;
    isProcessing.value=false;
  }
};

    //is product already in cart
    // const isProductAlreadyInCart=computed<boolean>(():boolean=>{
    //     const hasProduct=cartBasket.value.find((el:Iproduct)=>el?.id==product.value.id);
    //     return (hasProduct)?true:false;
    // });

</script>

<template>
    <Head title="Checkout" />
    <AuthenticatedLayout>
        <div class="p-4 mt-2 max-w-[1250px] mx-auto text-3xl font-extrabold">Checkout</div>
        <div class="flex max-w-[1250px] mx-auto pt-4">
            <div class="w-8/12">
                <div class="flex items-stretch border-b border-b-gray-300 w-[calc(100%-180px)] pb-4 pl-4 mb-6">
                    <div class="mr-12 text-xl font-extrabold text-gray-900">Shipping Address</div>
                    <div class="px-4 font-semibold">
                        {{ $page.props.auth.user.first_name }} {{ $page.props.auth.user.last_name }}
                        <div>{{ $page.props.auth.address?.add1 }}</div>
                        <div>{{ $page.props.auth.address?.add2}}</div>
                        <div>{{ $page.props.auth.address?.city }}</div>
                        <div>{{ $page.props.auth.address?.postcode }}</div>
                        <div>{{ $page.props.auth.address?.country }}</div>
                    </div>
                </div>
            </div>
            <div class="w-4/12 px-2 py-4 border border-gray-400 rounded-md">
                <form id="payment-form">
                    <div id="card-element"> <!----$tripe.js injects the card element--></div>
                    <div class="flex justify-between p-2 my-3 text-xl font-extrabold text-red-700 border-y border-y-gray-300">
                        <div>Order total:</div>
                        <div v-if="order">USD: {{order.total_decimal }}</div>
                    </div>
                    <button id="submit" class="text-sm bg-yellow-400 rounded-md hover:bg-yellow-500">
                        <div v-if="isProcessing">Processing...</div>
                        <div v-else id="button-text">Place your order in USD</div>
                     </button>
                     <!-- error -->
                      <p id="card-error" role="alert" class="font-semibold text-center text-red-700"></p>
                </form>
            </div>
        </div>
        <!-- items -->
         <div class="w-[1200px] mx-auto text-xl font-bold pb-2 underline">Items</div>
         <div class="w-[1200px] mx-auto" v-for="prod in JSON.parse(order?.items)" :key="prod.id">
            <div class="flex items-center py-1">
                <img width="60" :src="prod?.image" class="rounded-md" alt="" />
                <div class="ml-4">
                    <div class="text-lg font-semibold">{{ prod.title }}</div>
                    <div class="font-semibold text-red-700 ">{{ prod.price }}</div>
                </div>
            </div>
         </div>
    </AuthenticatedLayout>
</template>

<style scoped>
#card-element {
    border-radius: 4px 4px 0 0;
    padding: 12px;
    border: 1px solid rgba(50, 50, 93, 0.1);
    height: 44px;
    width: 100%;
    background: white;
}

#payment-request-button {
    margin-bottom: 32px;
}
</style>

