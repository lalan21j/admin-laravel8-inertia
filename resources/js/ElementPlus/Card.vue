<template>
  <el-card class="box-card" shadow="never">
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
  name: "layout.card",
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

.text {
  font-size: 14px;
}

.item {
  margin-bottom: 18px;
}

.box-card {
  /* width: 480px; */
}
</style>