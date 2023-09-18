<?php

namespace App\Enums;

enum Permission: string
{
        // * Resource
    case VIEW_ANY_RESOURCE = 'view_any_resource';
    case VIEW_RESOURCE = 'view_resource';
    case CREATE_RESOURCE = 'create_resource';
    case UPDATE_RESOURCE = 'update_resource';
    case DELETE_RESOURCE = 'delete_resource';

        // * Resource Protected
    case VIEW_PROTECTED_RESOURCE = 'view_protected_resource';
    case UPDATE_PROTECTED_RESOURCE = 'update_protected_resource';
    case DELETE_PROTECTED_RESOURCE = 'delete_protected_resource';

        // * File Resource
    case GET_FILE_RESOURCE = 'get_file_resource';
    case DOWNLOAD_FILE_RESOURCE = 'download_file_resource';
    case SHOW_FILE_RESOURCE = 'show_file_resource';

        // * File Resource Protected
    case GET_PROTECTED_FILE_RESOURCE = 'get_protected_file_resource';
    case DOWNLOAD_PROTECTED_FILE_RESOURCE = 'download_protected_file_resource';
    case SHOW_PROTECTED_FILE_RESOURCE = 'show_protected_file_resource';
}
