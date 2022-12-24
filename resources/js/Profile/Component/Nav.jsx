import React from 'react';
import { Link, useLocation } from 'react-router-dom';

const Nav = () => {
    const { pathname } = useLocation();

    return (
      <div className='container'>
        <div className="row">
            <div className="col">
                <nav aria-label="breadcrumb" className="bg-light rounded-3 p-3 mb-4">
                    <ol className="breadcrumb mb-0">
                        <li className={`breadcrumb-item ${pathname === '/' ? 'active' : ''}`}
                            ><Link to='/' >Profile</Link>
                        </li>
                        <li className={`breadcrumb-item ${pathname === '/cart' ? 'active' : ''}`}
                            ><Link to="/cart">Cart</Link>
                        </li>
                        <li className={`breadcrumb-item ${pathname === '/order' ? 'active' : ''}`}
                            ><Link to='/order'>Order List</Link>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
      </div>
  )
}

export default Nav;
