<template>
  <app-layout>
    <ele-card title="Gestión de roles">
      <template #actions-head>
        <div>
          <el-input v-model="search" placeholder="Buscar" style="width: 300px;" class="ml-2">
            <template #append>
              <el-button @click="getRoles" icon="el-icon-search" :loading="loading" />
            </template>
          </el-input>
        </div>
      </template>

      <ele-link type="danger" :href="route('teams.role.record')" text="Pdf" class="float-right" />
      <ele-button type="success" text="Nuevo" class="float-right" @click="statusModal = true" />

      <ele-table :records="list">
        <el-table-column prop="id" label="N°" width="40%">
          <template #default="scope">
            <span>{{ scope.$index+1 + (pagination.per_page * pagination.current_page) - pagination.per_page }}</span>
          </template>
        </el-table-column>
        <el-table-column prop="name" label="Roles" />
        <el-table-column prop="description" label="Descripción" />
        <el-table-column prop="" label="Acciones" width="100px" />
      </ele-table>

      <div class="float-right my-3">
        <el-pagination small
          @current-change="getRoles"
          layout="total, prev, pager, next"
          :page-size="pagination.per_page"
          :total="pagination.total"
          v-model:currentPage="pagination.current_page">
        </el-pagination>

      </div>
    </ele-card>

    <modal :dialog-visible="statusModal"
      @close="statusModal = $event"
      @updateRecords="getRoles" />
  </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import EleTable from '@/ElementPlus/Table.vue'
import EleCard from '@/ElementPlus/Card.vue'
import EleButton from '@/ElementPlus/Button.vue'
import EleLink from '@/ElementPlus/Link.vue'
import Modal from '@/Pages/Teams/Roles/Modal.vue'
import queryString from 'query-string'

export default defineComponent({
  name: 'teams.roles.index',
  components: {
    AppLayout, EleTable, EleCard, EleButton, EleLink, Modal
  },
  data () {
    return {
      search: '',
      loading: false,
      list: [],
      pagination: [],

      statusModal: false
    }
  },
  mounted () {
    this.getRoles()
  },
  methods: {
    async getRoles () {
      const records = await axios.get(`/role?${this.getQueryParameters()}`)
      this.list = records.data.data

      this.pagination = records.data
    },
    getQueryParameters () {
      return queryString.stringify({
        page: this.pagination.current_page,
        search: this.search
      })
    }
  }
})
</script>

<style scoped>

</style>
