
function has_error(var_input,input_name){
  if(var_input.val() == "" || var_input.val() == null){
    aList = ["data","senha"];
    artigo_a = aList.includes(input_name);

    $(`#erro-${input_name}`).html(`${artigo_a ? "A":"O"} ${input_name} é obrigatóri${artigo_a ? "a": "o"}`);
    return(true);
  }
};

$(function() {
  $("#toggleConfirmaSenha").on("click", function() {
    inputFields = $(".passwordInput");
    if(inputFields[1].type == "password"){
      console.log(inputFields[0]);
      inputFields[1].setAttribute("type","text");
    } else {
      inputFields[1].setAttribute("type","password");
    }
    this.classList.toggle("bi-eye");
  });

  $("#toggleSenha").on("click", function() {
    inputFields = $(".passwordInput");
    if(inputFields[0].type == "password"){
      console.log(inputFields[0]);
      inputFields[0].setAttribute("type","text");
    } else {
      inputFields[0].setAttribute("type","password");
    }

    this.classList.toggle("bi-eye");
  })
  
})

$(function(){

  $("#form-test").on("submit",function(){
    nome_input = $("input[name='nome']");
    email_input = $("input[name='email']");
    data_input = $("input[name='data']");
    senha_input = $("input[name='senha']");
    confirmaSenha_input = $("input[name='confirmaSenha']");
    imagem_input = $("input[name='imagem']");
    console.log(imagem_input.value);
    if(has_error(nome_input,"nome")) return false;
    $("#erro-nome").html("");

    if(has_error(email_input,"email")) return false;
    $("#erro-email").html("");

    if(has_error(data_input,"data")) return false;
    $("#erro-data").html("");

    if(has_error(senha_input,"senha")) return false;
    $("erro-senha").html("");

    if(has_error(confirmaSenha_input,"senha"))
    $("erro-senha").html("");
    return(true);
  });
});
