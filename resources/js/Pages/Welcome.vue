<template>
    <div>
        <p>{{ $page.props.appName}}</p>
        <inertia-link :href="route('home2')">Another</inertia-link>
        This is Welcome File.
    </div>
</template>