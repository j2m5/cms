<template>
  <v-card class="mb">
    <v-card-title class="headline">
      {{ title }}
    </v-card-title>
    <v-card-text>
      <form @submit.prevent="save(settingId)">
        <v-text-field v-model="setValue" :placeholder="placeholder" />
        <v-btn type="submit" color="primary" rounded>
          Сохранить
        </v-btn>
      </form>
    </v-card-text>
  </v-card>
</template>

<script>
import { update } from '../../../api/api'
export default {
  name: 'SettingItem',
  props: {
    settingId: {
      type: Number,
      required: true
    },
    value: {
      type: String,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    placeholder: {
      type: String,
      default: () => ''
    }
  },
  data() {
    return {
      setValue: ''
    }
  },
  watch: {
    value(value) {
      this.setValue = value
    }
  },
  methods: {
    save(id) {
      update('settings', id, { value: this.setValue }).then((res) => {
        this.$toast.success(res.data.success)
        if (id === 3) this.$store.dispatch('updateSiteLogo', this.setValue)
      }).catch((err) => {
        this.$toast.warning(err.response.data.errors)
      })
    }
  }
}
</script>

<style scoped>
.mb {
    margin-bottom: 15px;
}
</style>
