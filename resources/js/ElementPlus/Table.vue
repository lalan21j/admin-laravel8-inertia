<template>
  <el-table
    :data="records"
    stripe
    class="pt-4"
  >
    <slot />
  </el-table>
</template>

<script>
export default {
  name: 'ElementPlusTable',
  props: {
    records: {
      type: Array
    }
  }
}
</script>

<style>
</style>
