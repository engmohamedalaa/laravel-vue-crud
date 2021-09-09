<template>
    <div class="container">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <router-link active-class="active" exact class="nav-link" :to="{ name: 'posts.index'}">Posts List</router-link>
                <!--                <a class="nav-link active" aria-current="page" href="#">Active</a>-->
            </li>
            <li class="nav-item">
                <router-link active-class="active" exact class="nav-link" :to="{name:'posts.create'}">Create Post</router-link>
            </li>
        </ul>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>
<script></script>
