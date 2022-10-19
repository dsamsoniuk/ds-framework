app/
    cache.php
        path = '/cache'
        static get(name)
        static set(name, value)
        static clearAll()

    Exception/
        RouteException.php
        TemplateException.php
        CsrfException.php

    Secure/
        secureInterface.php
            check(Route route, Request req)
        csrf.php implements secureInterface
            check(Route route, Request req) :
                if (req->get('session', 'token') != req->get('get', 'token') )
                    throw CsrfException
        authorization.php implements secureInterface
            checkRoles(route, user) : 
                if (!in_array(route->roles, user->roles))
                    throw exception
            checkIsLogged(user) :
                if (is_empty(user)) {
                    throw exception
                }
            check(Route route, Request req) :
                user = req->get('session', 'user')
                this->checkIsLogged(user)
                this->checkRoles(route, user)

        guardian.php
            checkAccess(Route route, Request req) :
                for (route->secure as secure)
                    secure->check(route, req)

    route.php
        construct(url, controller, secure, func, roles)
        compareUrl(url)
            return url === this->url
        compareName(name)
            return name === this->name
        executeController()
            echo new this->controller->{func}()

    routing.php
        add(url, controller, secure)
            this->route_list[] = new Route(url, controller, secure)
        getRouteList(){
            if (empty(this->route_list)) {
                return Cache::get('route_list')
            } 
            return this->route_list
        }
        find(Request req) :
            for (this->getRouteList() route)
                if (route->compareUrl(req->getUrl()))
                    return route
        static findByName(name) : Route
            route_list = self::getRouteList()
            for (route_list route)
                if (route->compareName(Request))
                    return route

    core.php (Routing, Request)
        run() : 
            try catch
                route = this->routing->find(this->request)
                guardian = new Guardian()
                guardian->checkAccess(route, request)
                route->executeController()

    request.php
        get(type = 'GET', value = '')

    controller.php
        request(type)
            return new Request()
        renderTemplate(TemplateInterface templ, data) : 
            templ->render(data)
        renderView(path) :
            template = new TwigTemplate()
            this->renderTemplate(template)

    template/
        TemplateInterface.php
            render()
        TwigTemplate.php extends TemplateInterface
            render(name, data)
src/
    Controller/
        MainController extends controller
            index() : 
                route = Routing::findByName('main.index')

public/
    index.php
        req     = new Request()
        routing   = new Routing()

        routing->add('main.index', MainController, [ new Csrf, new Authorization ], 'index')

        core    = new Core(routing, req)
        core->run()