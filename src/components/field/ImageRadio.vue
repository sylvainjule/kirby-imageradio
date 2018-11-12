<template>
    <k-field v-bind="$props" :class="['k-radio-field', 'k-imageradio-field', {'has-gap': gap == true}]">
        <k-input ref="input" :id="_uid" v-bind="$props" theme="field" v-on="$listeners" />
    </k-field>
</template>

<script>
export default {
    extends: 'k-radio-field',
    props: {
        fit: String,
        gap: Boolean,
        mobile: Boolean,
        ratio: Number,
    }
}
</script>

<style lang="scss">
    @import '../../assets/css/styles.scss'
</style>