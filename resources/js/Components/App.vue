<script setup>
</script>
<template>
    <div class="container pt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <router-link to="/"> Home</router-link>
                </li>
            </ol>
        </nav>
        
        <router-view></router-view>
    </div>
</template>
