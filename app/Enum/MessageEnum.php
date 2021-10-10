<?php


namespace App\Enum;


abstract class MessageEnum
{
    const LoginError = 'Грешно въведено потребителско име или email';
    const UserExists = 'userexists';
    const UserDoesNotExist = 'userdoesnotexist';
    const SubmitQuizResponses = 'Попълнихте успешно избраната от вас анкета';
}