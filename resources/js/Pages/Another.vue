<template>
    <div>
        <p>{{ $page.props.appName}}</p>
        <inertia-link :href="route('home')">Home</inertia-link>
        This is Another Page.
    </div>
</template>