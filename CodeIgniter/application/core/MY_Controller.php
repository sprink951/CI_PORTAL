<?php if(!defined('BASEPATH')) exit('No direct script access allowed..');
/*************************************************************************
	> File Name: MY_Controller.php
	> Author: sprink
	> Mail: tangjing951@gmail.com 
	> Created Time: 2013年08月21日 星期三 08时55分58秒
 ************************************************************************/


/*************************************************************************
 * 默认控制器
 *
 * 设置默认编码为utf-8
 * 设置默认时区为东八区
 * SITE_RESOURCES           公共外部资源存放文件夹
 * SITE_COMMON_STATIC       （公共、前端、后端）样式、图片、脚本存放文件夹
 * SITE_UPLOADS             公共上传文件夹
 * SITE_THEMES              前端存放主题文件夹
 * SITE_ENCRYPTION_KEY_BEGIN开始密钥
 * SITE_ENCRYPTION_KEY_END  结束密钥
 * SITE_UPLOAD_IMAGE_SIZE   上传图片大小
 * SITE_UPLOAD_FLASH_SIZE   上传动画大小
 * SITE_UPLOAD_MEDIA_SIZE   上传视频大小
 * SITE_UPLOAD_FILE_SIZE    上传文件大小
 * SITE_NAME                站点名称
 * SITE_LOGO                站点LOGO
 * SITE_ICP                 站点备案号
 * SITE_STATISTICAL_CODE    站点统计代码
 * SITE_SHARE_CODE          站点分享代码
 * SITE_KEYWORDS            站点关键字
 * SITE_DESCRIPTION         站点描述
 * SITE_STATUS              站点状态
 * SITE_CLOSE_REASON        站点关闭原因
 * SITE_REG_AGREEMENT       站点注册协议
 * SITE_THEME               站点主题
 * SITE_STATIC              前端样式、图片、脚本存放位置
 ************************************************************************/

class MY_controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        header('Content-type:text/html; charset=utf-8');
        date_default_timezone_set('Asia/Shanghai');

        $config_common = $this->m_common->get_one('l_config_common');
        $config_site   = $this->m_common->get_one('l_config_site');
        
        define('SITE_RESOURCES',            base_url() . $config_common['site_resources']);

        define('SITE_COMMON_STATIC',        base_url() . $config_common['site_static']);
        define('SITE_UPLOADS',              base_url() . $config_common['site_uploads']);
        define('SITE_THEMES',               $config_common['site_themes']);
        define('SITE_ENCRYPTION_KEY_BEGIN', $config_common['site_encryption_key_begin']);
        define('SITE_ENCRYPTION_KEY_END',   $config_common['site_encryption_key_end']);
        define('SITE_UPLOAD_IMAGE_SIZE',    $config_common['site_upload_image_size']);
        define('SITE_UPLOAD_FLASH_SIZE',    $config_common['site_upload_flash_size']);
        define('SITE_UPLOAD_MEDIA_SIZE',    $config_common['site_upload_media_size']);
        define('SITE_UPLOAD_FILE_SIZE',     $config_common['site_upload_file_size']);
 
        define('SITE_NAME',                 $config_site['site_name']);
        define('SITE_LOGO',                 SITE_COMMON_STATIC . '/site/' . $config_site['site_theme'] . '/' . $config_site['site_logo']);
        define('SITE_ICP',                  $config_site['site_icp']);
        define('SITE_STATISTICAL_CODE',     $config_site['site_statistical_code']);
        define('SITE_SHARE_CODE',           $config_site['site_share_code']);
        define('SITE_KEYWORDS',             $config_site['site_keywords']);
        define('SITE_DESCRIPTION',          $config_site['site_description']);
        define('SITE_STATUS',               $config_site['site_status']);
        define('SITE_CLOSE_REASON',         $config_site['site_close_reason']);
        define('SITE_REG_AGREEMENT',        $config_site['site_reg_agreement']);
        define('SITE_THEME',                SITE_THEMES . '/' . $config_site['site_theme']);
 
        unset($config_common, $config_site);
 
        define('SITE_STATIC', SITE_COMMON_STATIC . '/site/' . str_replace(SITE_THEMES . '/', '', SITE_THEME));   
    }
}

/**************************************************************************************
 *后端控制器类
 *
 * SITE_ADMIN_NAME    站点后台名称
 * SITE_ADMIN_LOGO    站点后台LOGO
 * SITE_ADMIN_THEME   站点后台主题
 * SITE_ADMIN_STATIC  站点后台样式存放位置
 * ***********************************************************************************/
class A_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        //后台验证处理
        $this->load->model('portal/m_index');
    
        $session = $this->m_index->get_session();
        if($this->uri->uri_string == 'portal/index/login')       
        {
            if ($session['admin_uid'] && $session['admin_username'])
            {
                redirect('admin/index/index');
            }
        }
        else
        {
            if (!($session['admin_uid']) || !($session['admin_username']))
            {
                redirect('admin/index/login');
            } 
        }

        $config_site_admin = $this->m_common->get_one('l_config_site_admin');
        define('SITE_ADMIN_NAME',$config_site_admin['site_admin_name']);
        define('SITE_ADMIN_THEME',$config_site_admin['site_admin_theme']);

        unset($config_site_admin);

    }

}

class M_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }
}
?>
