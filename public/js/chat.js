/**
 * باخد سوكيت اوبجيكت و اباصيله
 * - سوكت سيرفر
 * - registerQuery -> اما بسجل اى دي او بشترك بتشانل
 * باخد اوبكت من كلاس الشات واباصيله
 * - معرف الشات بوكس
 * - معرف التيكست ايريا
 * - معرف زرار السيند
 * الاوردار اى دي-
 *
 * باخد من الاوبجت كلاس فانكشن الريندير فيو ان واباصيلها اوبجيت السوكيت و مسدج كويري
 *
 *  renderViewIn بتاخد الرسالة من التيكست ايريا و تشوف انا دوست سيند او دوست انتر و ترمى الرسالة على
 *  sendHelper
 * بتاخد الرسالة تبعتها للسوكيت و تفضى التيكست ايريا و بعدين تروح تعرض الرسالة فى البوكس عند الى باعت من
 * msgInComponent
 */

class Chat {
    constructor(chatBoxParentID, textAreaID, sendBtnID, orderId, designvar) {
        this.chatBoxParentID = chatBoxParentID;
        this.textAreaID = textAreaID;
        this.sendBtnID = sendBtnID;
        this.orderId = orderId;
        this.designvar = designvar;
        this.Config = {
            chatAPIUrl: '/testmsg/' + this.orderId + '?page=',
            currentPage: 2,
            lastPage: 3,
            busy: false
        }
        this.startChatBoxWithDownScroll();
        this.chatBoxScrollEvent();
        this.startChatBoxWithDownScroll();
        setInterval(function() {
            if (document.visibilityState === 'visible') {
                var dateElements = document.querySelectorAll('[data-current-date]');
                [].forEach.call(dateElements, function(dateElement) {
                    let realDate = dateElement.getAttribute('data-current-date');
                    dateElement.innerHTML = moment(realDate).locale('ar').fromNow()
                });
            }
        }, 2000);
    }

    startChatBoxWithDownScroll() {
        document.getElementById(this.chatBoxParentID).scrollTop = document.getElementById(this.chatBoxParentID).scrollHeight;
    }

    chatBoxScrollEvent() {
        var self = this;
        $('#' + this.chatBoxParentID).scroll(function() {
            if ($(this).scrollTop() < 50) {
                self.callMsgFromAPI();
            }

        }).scroll();
    }


    callMsgFromAPI() {

        if (this.Config.busy === false && this.Config.currentPage <= this.Config.lastPage) {
            this.Config.busy = true;
            // console.log('current: ' + this.Config.currentPage + 'last: ' + this.Config.lastPage);
            var self = this;
            const chatBox = document.getElementById(this.chatBoxParentID);

            axios.get(this.Config.chatAPIUrl + this.Config.currentPage).then(response => {
                self.Config.lastPage = response.data.massage.last_page;
                const MsgArray = response.data.massage.data;
                MsgArray.forEach(MSG => {
                    const htmlText = (self.designvar == 'markter') ? self.msgComponentAsHtml2(MSG.msg, MSG.type == 'manager' ? 'right' : 'left', MSG.created_at, MSG.sender_name) : self.msgComponentAsHtml(MSG.msg, MSG.type == 'manager' ? 'right' : 'left', MSG.created_at, MSG.sender_name);

                    const parser = new DOMParser();
                    const parsedHtml = parser.parseFromString(htmlText, 'text/html').body.firstChild;
                    chatBox.insertBefore(parsedHtml, chatBox.firstChild);
                });
                this.Config.currentPage++;
                this.Config.busy = false;
            });
        }
    }

    renderJSON(data) {
        const getMsg = document.getElementById(this.textAreaID).value;
        data.message = getMsg.split("\n")[0]
            // return JSON.stringify(data);
        return data;
    }

    sendHelper(socket, data) {
        let message = document.getElementById(this.textAreaID).value;
        socket.emit('message:send', this.renderJSON(data))
        const messageQuery = {
            channel: 'mynotfy',
            type: this.renderJSON(data).type,
            sender_id: (this.renderJSON(data).channel),
            order_id: this.renderJSON(data).order_id,
            sender_name: this.renderJSON(data).sender_name,
            message: this.renderJSON(data).message
        };

        socket.emit('message:send', messageQuery)

        this.sendMsg2DB(data)
        document.getElementById(this.textAreaID).value = null;
        const chatBox = document.getElementById(this.chatBoxParentID);
        const msgComponent = this.msgInComponent(message, data);
        chatBox.appendChild(msgComponent)
        this.startChatBoxWithDownScroll();

        if (messageQuery.type == 'manager') {
            $.ajax({
                url: "/manager/seen_notifications3",
                type: 'get',
                data: {
                    'type': "App\\Notifications\\GlobalNotification",
                    'chat_id': messageQuery.order_id
                },
                success: function(data) {
                    console.log('124578')
                }
            });
        }
    }

    renderViewIn(socket, data) {
        if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            document.getElementById(this.textAreaID).addEventListener('keyup', event => {
                if (event.isComposing || event.keyCode == 13) {
                    this.sendHelper(socket, data)
                }
            })
            console.log("i'm not phone");
            console.log(navigator.userAgent);
        }
        const viewInBtn = document.getElementById(this.sendBtnID);
        viewInBtn.addEventListener('click', (event) => {
            this.sendHelper(socket, data)
        })
    }

    renderViewOut(data) {

        const htmlText = (this.designvar == 'markter') ? this.msgComponentAsHtml2(data.message, 'left', new Date().toString(), data.from_name) : this.msgComponentAsHtml(data.message, 'left', new Date().toString(), data.from_name);

        const chatBox = document.getElementById(this.chatBoxParentID);
        const parser = new DOMParser();
        const parsedHtml = parser.parseFromString(htmlText, 'text/html').body.firstChild;
        chatBox.appendChild(parsedHtml)
        this.startChatBoxWithDownScroll();
    }

    msgComponentAsHtml(msg, direction = 'right', date = '2022-02-02', name = "user") {
        return `
            <div class="chat-message ${direction}">
                <div class="message">
                    <a class="message-author" href="#"> ${name}</a>
                    <span class="message-date" data-current-date="${date}">
                    ${moment(date).locale('ar').fromNow()}
                    </span>
                    <span class="message-content">
                    ${msg}
                    </span>
                </div>
            </div>
        `;
    }

    msgComponentAsHtml2(msg, direction = 'right', date = '2022-02-02', name = "user") {
        return `
            <div class="containerChat  ${(direction == 'left') ? 'containerChatMR' :  'darker containerChatML' }">
            <img src="http://jiovaniaff.test/photos/icon.png" alt="Avatar"
                class="${direction}">
            <p>${msg}</p>
            <span class="time-${direction}" data-current-date="${date}">
            ${moment(date).locale('ar').fromNow()}
            </span>
        </div>
        `;
    }

    msgInComponent(msg, data) {

        const htmlText = (this.designvar == 'markter') ? this.msgComponentAsHtml2(msg, 'right', new Date().toString(), data.from_name) : this.msgComponentAsHtml(msg, 'right', new Date().toString(), data.from_name);

        const parser = new DOMParser();
        const parsedHtml = parser.parseFromString(htmlText, 'text/html');
        return parsedHtml.body.firstChild
    }

    sendMsg2DB(msgQuery) {

        axios({
                method: 'post',
                url: '/api/v1/send-msg',
                data: msgQuery
            }).then(function(response) {
                console.log(response);
            })
            .catch(function(error) {
                console.log(error);
            });
    }
}