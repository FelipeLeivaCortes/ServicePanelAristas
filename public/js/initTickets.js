
/**
 * Función que permite estructurar en pantalla el hilo de un ticket.
 * 
 * @param {Object} ticket Ticket
 * @param {string} author Nombre del emisor del ticket
 * @param {string} avatar_url URL del avatar del usuario
 * @param {string} avatar_superAdmin_url URL del avatar del SuperAdmin
 */
const initTickets   = (ticket, author, avatar_url, avatar_superAdmin_url) => {
    const descriptions = JSON.parse(ticket.description || '[]');
    const answers = JSON.parse(ticket.answer || '[]');
    const limit = descriptions.length + answers.length;

    let index_descriptions = 0;
    let index_answers = 0;

    let has_descriptions = descriptions.length > 0;
    let has_answers = answers.length > 0;

    for (let i = 0; i < limit; i++) {
        if (has_descriptions && !has_answers) {
            create_chat(author, descriptions[index_descriptions].msg, descriptions[index_descriptions].date, avatar_url, true);
            index_descriptions++;
            has_descriptions = index_descriptions < descriptions.length;
        } else if (!has_descriptions && has_answers) {
            create_chat('Web Master', answers[index_answers].msg, answers[index_answers].date, avatar_superAdmin_url, false);
            index_answers++;
            has_answers = index_answers < answers.length;
        } else {
            if (new Date(descriptions[index_descriptions].date) <= new Date(answers[index_answers].date)) {
                create_chat(author, descriptions[index_descriptions].msg, descriptions[index_descriptions].date, avatar_url, true);
                index_descriptions++;
                has_descriptions = index_descriptions < descriptions.length;
            } else {
                create_chat('Web Master', answers[index_answers].msg, answers[index_answers].date, avatar_superAdmin_url, false);
                index_answers++;
                has_answers = index_answers < answers.length;
            }
        }
    }
}

/**
 * 
 * @param {string} name : Name of the message's author
 * @param {string} msg : Message of the chat
 * @param {int} date: Timestap of the message
 * @param {string} url : URL of the avatar
 * @param {boolean} is_client : The message is the right or left side
 */
function create_chat(name, msg, date, url, is_client)
{
    let orientation = is_client ? 'justify-content-start ' : 'justify-content-end ';

    let li          = $('<li></li>', {class: orientation + ' mb-4 row'});
    let image       = $('<img></img>', {class: "avatar rounded-circle mr-2",
                                        src: url,
                                        alt: 'avatar',
                                        style: 'width: 50px; max-height: 50px;'});
    let chat;

    /**
     * If the message must be in the client side
     */
    if ( is_client ) {
        chat    =   $('<div></div>', {class: 'chat-body white p-3 ml-2 z-depth-1'}).append(
                        $('<div></div>', {class: 'row'}).append(
                            image
                        ).append(
                            $('<div></div>', {class: 'header'}).append(
                                $('<strong></strong', {class: 'primary-font', text: name})
                            ).append(
                                $('<br>')
                            ).append(
                                $('<small></small>', {class: 'pull-right text-muted'}).append(
                                    $('<i></i>', {class: 'far fa-clock', text: ' ' + formatDate(date)})
                                )
                            )
                        )
                    ).append(
                        $('<hr></hr>', {class: 'w-100'})
                    ).append(
                        $('<p></p>', {class: 'mb-0', text: msg})
                    );

    } else {
        chat    =   $('<div></div>', {class: 'chat-body white p-3 ml-2 z-depth-1'}).append(
                        $('<div></div>', {class: 'row d-flex' + orientation}).append(
                            $('<div></div>', {class: 'header mr-2'}).append(
                                $('<strong></strong', {class: 'primary-font', text: name})
                            ).append(
                                $('<br>')
                            ).append(
                                $('<small></small>', {class: 'pull-right text-muted'}).append(
                                    $('<i></i>', {class: 'far fa-clock', text: ' ' + formatDate(date)})
                                )
                            )
                        ).append(
                            image
                        )
                    ).append(
                        $('<hr></hr>', {class: 'w-100'})
                    ).append(
                        $('<p></p>', {class: 'mb-0', text: msg})
                    );
    }

    li.append(chat);
    $('#messages').append(li);
}

function formatDate(timestamp) {
    // Convertir el timestamp a milisegundos
    const date = new Date(timestamp * 1000);

    // Formatear la fecha y hora
    const day       = String(date.getDate()).padStart(2, '0');
    const month     = String(date.getMonth() + 1).padStart(2, '0'); // Los meses en JavaScript van de 0 a 11
    const year      = date.getFullYear();
    const hours     = String(date.getHours()).padStart(2, '0');
    const minutes   = String(date.getMinutes()).padStart(2, '0');
    const seconds   = String(date.getSeconds()).padStart(2, '0');

    return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
}