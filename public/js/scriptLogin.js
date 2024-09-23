axios.post('/login', loginData)
  .then(response => {
    if (response.data.message === 'login sukses') {
      window.location.href = response.data.data.redirect_url;
    }
  })
  .catch(error => {
    console.error(error.response.data.message);
  });
