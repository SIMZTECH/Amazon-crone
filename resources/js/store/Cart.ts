import { defineStore } from "pinia"
import { ref } from "vue";

export interface Iproduct{
    id:number,
    title:string,
    description:string,
    category:number,
    image:string,
    price:number
}

export const useCart = defineStore('cart', () => {
    const cartBasket = ref<Iproduct[]>([]);

    // add to cart

    // remove from cart
    function removeFromCart(productId:number){
        cartBasket.value.forEach((product,index)=>{
            if(product?.id===productId){
                cartBasket.value.splice(index,1);
            }
        });
    }

    // update cart

    // clear cart
  
    return {cartBasket,removeFromCart}
  },{persist:true})