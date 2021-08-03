class Messager {
  constructor() {
    this.buttonInsertName = document.querySelector('#insert-name button');
    this.messagesContainer = document.querySelector('#messages-container');
    this.nicknameContainer = document.querySelector('#nickname-container');
    this.message = document.querySelector('#message');
    this.currentMessages = '';

    this.request = new XMLHttpRequest();
    this.requestTarget = '/src/messager.php';

    this.configUser();

    document.querySelector('#send-message').addEventListener('click', () => {
      messager.sendMessage();
    });
  }

  configUser() {
    if (localStorage.getItem('userId') === null) {
      this.buttonInsertName.addEventListener('click', () => {
        let nickname = this.buttonInsertName.parentElement.childNodes[1].value;
        if (nickname !== '') {

          localStorage.setItem('userId', Math.random().toString(36).substr(2, 9));
          localStorage.setItem('nickname', nickname);

          this.userId = localStorage.getItem('userId');
          this.nickname = localStorage.getItem('nickname');

          this.buttonInsertName.parentElement.remove();
          this.startGetMessages();

        } else {

          alert('Digite um nick válido, homo sapiens.');

        }
      });
    } else {
      this.buttonInsertName.parentElement.remove();
      this.userId = localStorage.getItem('userId');
      this.nickname = localStorage.getItem('nickname');
      this.startGetMessages();
    }
  }

  getMessages() {
    this.sendRequest(
      {
        type: 'GET_MESSAGES',
        nickname: this.nickname,
        userId: this.userId
      }
    );
  }

  startGetMessages() {
    setInterval(() => {
      this.getMessages();
    }, 1000);
  }

  sendMessage() {
    this.sendRequest(
      {
        type: 'PUT_MESSAGE',
        msg: this.message.value,
        nickname: this.nickname,
        userId: this.userId
      }
    );
    this.lastMessage = this.message.value;
    this.message.value = '';
  }

  sendRequest(request) {
    this.request.open('POST', this.requestTarget);
    this.request.setRequestHeader('Content-Type', 'application/json');
    this.request.onreadystatechange = () => {
      if (this.request.readyState === 4 && this.request.status === 200) {
        let response = this.request.responseText.replace('[', '');
        response = response.replace(']', '');

        if (response !== this.currentMessages && response !== '') {

          let newMessages = this.request.responseText.replace(this.currentMessages, '');
          newMessages = newMessages.replace('[,', '[',);
          this.currentMessages = response;
          console.log('NEW MSG');
          this.generateDivs(newMessages);
        } else {
          console.log('NO NEW MSG');
        }
      }
    }
    this.request.send(JSON.stringify(request));
  }

  generateDivs(JSONMessagens) {
    // console.log(JSONMessagens);
    JSON.parse(JSONMessagens).forEach(message => {
      let container = document.createElement('div');
      container.classList.add('msg');
      container.classList.add(message['_user_id'] === this.userId ? 'current-user-msg' : 'another-user-msg');

      let msgHeader = document.createElement('div')
      msgHeader.classList.add('msg-header');

      let userNameContainer = document.createElement('span')
      let userName = document.createTextNode(message['user_nickname'] + '#');
      userNameContainer.appendChild(userName)

      let userIdContainer = document.createElement('span')
      let userId = document.createTextNode(message['_user_id']);
      userIdContainer.appendChild(userId)

      msgHeader.appendChild(userNameContainer);
      msgHeader.appendChild(userIdContainer);

      let msgContainer = document.createElement('p');
      let msg = document.createTextNode(this.utf8Decode(message['msg']));

      msgContainer.appendChild(msg);

      container.appendChild(msgHeader);
      container.appendChild(msgContainer);

      this.messagesContainer.appendChild(container);

    });

    this.messagesContainer.scrollTop = this.messagesContainer.scrollHeight;
  }

  utf8Decode(text) {
    var replace = [
      '&Aacute;',
      '&aacute;',
      '&Acirc;',
      '&acirc;',
      '&Agrave;',
      '&agrave;',
      '&Aring;',
      '&aring;',
      '&Atilde;',
      '&atilde;',
      '&Auml;',
      '&auml;',
      '&AElig;',
      '&aelig;',
      '&Eacute;',
      '&eacute;',
      '&Ecirc;',
      '&ecirc;',
      '&Egrave;',
      '&egrave;',
      '&Euml;',
      '&euml;',
      '&ETH;',
      '&eth;',
      '&Iacute;',
      '&iacute;',
      '&Icirc;',
      '&icirc;',
      '&Igrave;',
      '&igrave;',
      '&Iuml;',
      '&iuml;',
      '&Oacute;',
      '&oacute;',
      '&Ocirc;',
      '&ocirc;',
      '&Ograve;',
      '&ograve;',
      '&Oslash;',
      '&oslash;',
      '&Otilde;',
      '&otilde;',
      '&Ouml;',
      '&ouml;',
      '&Uacute;',
      '&uacute;',
      '&Ucirc;',
      '&ucirc;',
      '&Ugrave;',
      '&ugrave;',
      '&Uuml;',
      '&uuml;',
      '&Ccedil;',
      '&ccedil;',
      '&Ntilde;',
      '&ntilde;'
    ]

    var replaceBy =
      [
        'Á',
        'á',
        'Â',
        'â',
        'À',
        'à',
        'Å',
        'å',
        'Ã',
        'ã',
        'Ä',
        'ä',
        'Æ',
        'æ',
        'É',
        'é',
        'Ê',
        'ê',
        'È',
        'è',
        'Ë',
        'ë',
        'Ð',
        'ð',
        'Í',
        'í',
        'Î',
        'î',
        'Ì',
        'ì',
        'Ï',
        'ï',
        'Ó',
        'ó',
        'Ô',
        'ô',
        'Ò',
        'ò',
        'Ø',
        'ø',
        'Õ',
        'õ',
        'Ö',
        'ö',
        'Ú',
        'ú',
        'Û',
        'û',
        'Ù',
        'ù',
        'Ü',
        'ü',
        'Ç',
        'ç',
        'Ñ',
        'ñ'
      ]

    for (var index = replace.length - 1; index >= 0; index--) {
      text = text.replaceAll(replace[index], replaceBy[index]);
    }

    return text;
  };
}

/**
 * console.log('RESPONSE:');
 * console.log(response);
 * console.log('NEW:');
 * console.log(newMessages);
 * console.log('CURRENT:');
 * console.log(this.currentMessages);
 */