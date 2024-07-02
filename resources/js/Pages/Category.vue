<script setup lang="ts">
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    import ProductItemComponent from '@/Components/ProductItemComponent.vue'
    
</script>

<template>
    <Head title="Category" />
    <AuthenticatedLayout>
        <div class="w-full p-1 pt-2 mb-6">
            <div class="text-[27px] font-extrabold">{{$page.props.category_name.name }}</div>
            <div class="text-sm font-bold">
                Shop home entertainment, TV, home audio, headphones, camera,accessories and more
            </div>
            <div>
                1-{{$page.props.category_by_id.length}} of over {{$page.props.category_by_id.length}} results for {{$page.props.category_name.name}}
                
            </div>
            <!-- products grid -->
             <div class="grid grid-cols-4 gap-1">
                <ProductItemComponent 
                    v-for="product in $page.props.category_by_id" 
                    :product="product" 
                    :key="product"
                    />
             </div>
        </div>

    </AuthenticatedLayout>
</template>

