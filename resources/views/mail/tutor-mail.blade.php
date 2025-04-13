<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Status do Paciente</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      color: #333;
      padding: 20px;
    }
    .email-container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    .header {
      text-align: center;
      color: #28a745;
    }
    .content {
      margin-top: 20px;
      line-height: 1.6;
    }
    .footer {
      margin-top: 30px;
      font-size: 0.9em;
      color: #555;
    }
    .signature {
      margin-top: 15px;
    }
  </style>
</head>
<body>
  <div class="email-container">
    <h2 class="header">Hospital Veterinário Vida Animal</h2>
    
    <div class="content">
      <p>Olá <strong>Sr(a). {{ $data['ownerName'] }}</strong>,</p>

      <p>Estamos passando para atualizar você sobre o estado do seu(a) querido(a) companheiro(a), <strong>{{ $data['patientName'] }}</strong>.</p>

      <p>Ele(a) passou por uma avaliação recentemente e está sendo bem cuidado(a) pela nossa equipe médica. Neste momento, seu quadro é <strong>estável</strong> e estamos seguindo com os cuidados necessários para sua recuperação.</p>

      <p>Sabemos o quanto ele(a) é importante para você, e estamos fazendo tudo com muito carinho e profissionalismo para que ele(a) se sinta seguro(a) e confortável.</p>

      <p>Manteremos você informado(a) sobre qualquer novidade. Se quiser conversar conosco ou tiver alguma dúvida, estamos à disposição!</p>
    </div>

    <div class="footer">
      <p>Com carinho,</p>
      <p class="signature"><strong>Equipe Hospital Veterinário Vida Animal</strong><br>
      Atendimento 24h | (11) 1234-5678<br>
      contato@vidaanimal.vet.br</p>
    </div>
  </div>
</body>
</html>
