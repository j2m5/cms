export default {
  methods: {
    showErrors(errors) {
      if (errors.response.data.forbidden) {
        this.$toast.warning(errors.response.data.errors)
      } else {
        for (const error in errors.response.data.errors) {
          errors.response.data.errors[error].forEach(e => {
            this.$toast.warning(e)
          })
        }
      }
    }
  }
}
