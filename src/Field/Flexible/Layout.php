<?php
/**
 * Layout class for the flexible field
 */

namespace Geniem\ACF\Field\Flexible;

/**
 * Class Layout
 */
class Layout extends \Geniem\ACF\Field\Groupable {
    /**
     * Layout label
     *
     * @var string
     */
    protected $label;

    /**
     * Layout key
     *
     * @var string
     */
    protected $key;

    /**
     * Layout name
     *
     * @var string
     */
    protected $name;

    /**
     * Layout subfields
     *
     * @var array
     */
    public $sub_fields;

    /**
     * Exclude the layout from post types
     *
     * @var array
     */
    protected $exclude_post_types;

    /**
     * Display mode
     *
     * @var string
     */
    protected $display = 'block';

    /**
     * Constructor
     *
     * @param string      $label Layout label.
     * @param string|null $key   Layout key.
     * @param string|null $name  Layout name.
     */
    public function __construct( string $label, string $key = null, string $name = null ) {
        $this->label = $label;

        $this->key = $key ?? sanitize_title( $label );

        $this->name = $name ?? sanitize_title( $label );

        $this->active = 1;

        parent::__construct( $this );
    }

    /**
     * Prevent raw cloning.
     *
     * @return void
     */
    private function __clone() {}

    /**
     * Clone method
     *
     * Forces the developer to give new key to cloned field.
     *
     * @param  string      $key  New field key.
     * @param  string|null $name New field name.
     * @return Geniem\ACF\Field
     */
    public function clone( $key, $name = null ) {
        $clone = clone $this;

        $clone->set_key( $key );

        if ( isset( $name ) ) {
            $clone->set_name( $name );
        }

        $clone->reset();

        return $clone;
    }

    /**
     * Set label
     *
     * @param string $label New label.
     * @return self
     */
    public function set_label( string $label ) {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string Label
     */
    public function get_label() {
        return $this->label;
    }

    /**
     * Set key
     *
     * @param string $key New key.
     * @return self
     */
    public function set_key( string $key ) {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return string Key
     */
    public function get_key() {
        return $this->key;
    }

    /**
     * Set name
     *
     * @param string $name New name.
     * @return self
     */
    public function set_name( string $name ) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string Name
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * Set display mode
     *
     * @param string $display_mode Display mode to set.
     * @throws \Geniem\ACF\Field Info about invalid display mode.
     * @return self
     */
    public function set_display_mode( string $display_mode = 'block' ) {
        if ( ! in_array( $display_mode, [ 'block', 'table', 'row' ] ) ) {
            throw new \Geniem\ACF\Field( 'Geniem\ACF\FlexibleLayout: set_display_mode() does not accept argument "' . $display_mode . '"' );
        }

        $this->display = $display_mode;

        return $this;
    }

    /**
     * Exclude the post type.
     *
     * @param string $post_type The post type to exclude this layout from.
     * @return self
     */
    public function exclude_post_type( string $post_type ) {
        $this->exclude_post_types[] = $post_type;

        $this->exclude_post_types = array_unique( $this->exclude_post_types );

        return $this;
    }

    /**
     * Set all post types to exclude.
     *
     * @param array $post_types The post types to exclude this layout from.
     * @return self
     */
    public function set_excluded_post_types( array $post_types ) {
        $this->exclude_post_types = $post_types;

        return $this;
    }

    /**
     * Remove a post type from the excluded post types list.
     *
     * @param string $post_type The post type to remove from the excluded list.
     * @return self
     */
    public function remove_excluded_post_type( string $post_type ) {
        unset( $this->exclude_post_types[ $post_type ] );

        return $this;
    }

    /**
     * Get the list of excluded post types.
     *
     * @return array Excluded post types.
     */
    public function get_excluded_post_types() {
        return $this->exclude_post_types;
    }
}
