<template>
  <el-card shadow="never">
    <template #header>
      <div class="card-header">
        <span class="font-bold">{{ title }}</span>
        <slot name="actions-head" />
      </div>
    </template>
    <slot />
  </el-card>
</template>

<script>
export default {
  name: 'ElementPlusCard',
  props: {
    title: {
      type: String,
      default: ''
    }
  }
}
</script>

<style scoped>
.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
</style>
